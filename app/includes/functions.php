<?php

// Start PHP session
use class\Member;

session_start();

/**
 * Load configuration from includes/config.php
 *
 * @return array
 */
function getConfig(): array {
    static $config = null;

    if (is_null($config)) {
        $config = include('config.php');
    }

    return $config;
}

/**
 * Create a PDO connection and return it
 *
 * @return PDO
 * @throws Exception
 */
function createPdo(): PDO {
    $config = getConfig();

    try {
        $dsn = vsprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8', [
            $config['db_host'],
            $config['db_port'],
            $config['db_name'],
        ]);

        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    } catch (\Exception $e) {
        throw new \Exception('Database error: ' . $e->getMessage());
    }

    return $pdo;
}

/**
 * Get the PDO instance
 *
 * @return PDO
 */
function getPdo(): PDO {
    static $pdo = null;

    if (is_null($pdo)) {
        $pdo = createPdo();
    }

    print_r($pdo);

    return $pdo;
}

require 'classes/member.php';
$member = new Member();

/**
 * Get the current page from the URL
 *
 * @return array
 */
function pageGetCurrent(): array {
    $config = getConfig();
    $pages = $config['views'];
    $default = $config['default_page'];

    $URI = $_SERVER['REQUEST_URI'];
    $URI = explode('/', filter_var($URI, FILTER_SANITIZE_URL));

    $page = '/' . ($URI[1] ?? $default);

    foreach ($pages as $key => $value) {
        if (in_array($page, $value['urlPath'])) {
            return $value;
        }
    }

    return $pages['404'];
}

function getAllMembers(): array {
    $query = getPdo()->query('SELECT * FROM membres');
    $members = $query->fetchAll();

    return $members;
}

function getMemberById($id) {
    $id = (int) $id;
    $query = getPdo()->prepare('SELECT * FROM membres WHERE id = :id');
    $query->execute([
        'id' => $id,
    ]);
    $member = $query->fetch();

    return $member;
}

function deleteMember($id) {
    $id = (int) $id;
    $query = getPdo()->prepare('DELETE FROM `membres` WHERE `id` = :id');
    $query->execute([
        'id' => $id,
    ]);
}


/**
 * Configure the router with pages from the configuration
 *
 * @param \src\Router\Router $router
 */
function configureRouter(\src\Router\Router $router): void {
    $config = getConfig();
    foreach ($config['views'] as $page) {
        foreach ($page['urlPath'] as $path) {
            $router->get($path, function () use ($page) {
                $page_title = $page['title'];
                require_once __DIR__ . '/../views/layout.php';
            });
        }
    }
}

/**
 * Configure the custom 404 handler
 *
 * @param \src\Router\Router $router
 */
function configure404Handler(\src\Router\Router $router): void {
    $router->set404(function () {
        header('Location: http://127.0.0.1/404');
    });
}

// Get current page info
$thispage = pageGetCurrent();

// Redirect to login if the page is protected and the user is not logged in
 if ($thispage['protected'] === true && !$member->isLogged()) {
    header('Location: index.php?page=connexion');
    exit;
 }

// Set the page title
$page_title = $thispage['title'];

// Start output buffering
ob_start();

// Capture the content
$page_content = ob_get_contents();

// End output buffering
ob_end_clean();