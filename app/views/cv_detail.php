<?php

    if (!$member->isLogged()) {
        header('Location: login');
        exit;
    }

    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM cvs WHERE id = :id');
    $query->execute(['id' => $id]);
    $cv = $query->fetch();

    if (!$member->isLogged() || $member->get('id') !== $cv['user_id']) {
        echo "<script>window.location.href = '/cv/';</script>";
        exit;
    }

    if (!$cv) {
        echo "<script>'=window.location.href = '/home';</script>";
        exit;
    }

?>

<div class="min-h-screen bg-base-200 flex flex-col items-center">
    <div class="w-full max-w-md mt-4 px-4">
        <div class="card w-full pt-12">
            <div class="card-body">
                <h1 class="text-xl font-bold text-center">CV Details</h1>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($member->get('firstname')); ?></p>
                <p><strong>FirstName</strong> <?php echo htmlspecialchars($member->get('lastname')); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($cv['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($cv['phone']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($cv['address']); ?></p>
                <p><strong>Education:</strong> <?php echo nl2br(htmlspecialchars($cv['education'])); ?></p>
                <p><strong>Experience:</strong> <?php echo nl2br(htmlspecialchars($cv['experience'])); ?></p>
                <p><strong>Skills:</strong> <?php echo nl2br(htmlspecialchars($cv['skills'])); ?></p>
                <div class="flex justify-end mt-4">
                    <form method="POST" action="/cv/download">
                        <input type="hidden" name="cv_id" value="<?php echo $cv['id']; ?>">
                        <button type="submit" class="btn btn-primary">Download PDF</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>