<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cv_id'])) {
    $cvId = $_POST['cv_id'];
    
    if (empty($cvId)) {
        error_log('cv_id is empty');
        header('Location: /home');
        exit;
    }

    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM cvs WHERE id = :id');
    $query->execute(['id' => $cvId]);
    $cv = $query->fetch();

    if ($cv) {
        try {
            $member->generatePdf($cv);
            exit;
        } catch (Exception $e) {
            error_log('PDF generation failed: ' . $e->getMessage());
            header('Location: /home');
            exit;
        }
    } else {
        error_log('No CV found for id: ' . $cvId);
        header('Location: /home');
        exit;
    }
} else {
    error_log('Invalid request method or cv_id not set');
    header('Location: /login');
    exit;
}
?>