<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cv_id'])) {
    $id = $_POST['cv_id'];
    echo $id;
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM cvs WHERE id = :id');
    $query->execute(['id' => $id]);
    $cv = $query->fetch();

    try {
        if (!$member->isLogged() || $member->get('id') !== $cv['user_id ']) {
            echo "<script>window.location.href = '/cv/';</script>";
            exit;
        }
        if (!$cv) {
            echo "<script>window.location.href = '/home';</script>";
            exit;
        }
    } catch (Exception $e) {
        error_log('Something went wrong: ' . $e->getMessage());
        header('Location: /home');
        exit;
    }

    $query = $pdo->prepare('DELETE FROM cvs WHERE id = :id');
        $query->execute(['id' => $id]);

    echo "<script>window.location.href = '/cv/';</script>";
    exit;
}

echo "<script>window.location.href = '/cv/';</script>";
exit;

?>