<?php
// /cv/delete/(\d+)

if (!$member->isLogged()) {
    echo "<script>'=window.location.href = '/login';</script>";
    exit;
}

if (isset($page[2])) {
    $id = $page[2];
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM cvs WHERE id = :id');
    $query->execute(['id' => $id]);
    $cv = $query->fetch();

    if (!$member->isLogged() || $member->get('id') !== $cv['member_id']) {
        echo "<script>window.location.href = '/cv/';</script>";
        exit;
    }

    if (!$cv) {
        echo "<script>window.location.href = '/home';</script>";
        exit;
    }

    $query = $pdo->prepare('DELETE FROM cvs WHERE id = :id');
    $query->execute(['id' => $id]);

    echo "<script>window.location.href = '/cv/';</script>";
    exit;
}

echo "<script>window.location.href = '/cv/';</script>";

?>