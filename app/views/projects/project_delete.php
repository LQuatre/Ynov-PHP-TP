<?php
// /project/delete/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id'])) {
    $id = $_POST['project_id'];
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM projects WHERE id = :id');
    $query->execute(['id' => $id]);
    $project = $query->fetch();

    try {
        if (!$member->isLogged() || $member->get('id') !== $project['user_id']) {
            echo "<script>window.location.href = '/project/';</script>";
            exit;
        }
        if (!$project) {
            echo "<script>window.location.href = '/home';</script>";
            exit;
        }
    } catch (Exception $e) {
        error_log('Something went wrong: ' . $e->getMessage());
        header('Location: /home');
        exit;
    }
    $query = $pdo->prepare('DELETE FROM projects WHERE id = :id');
    $query->execute(['id' => $id]);

    echo "<script>window.location.href = '/cv/';</script>";
    exit;
}

echo "<script>window.location.href = '/project/';</script>";
exit;

?>