<?php

if (!$member->isLogged()) {
    header('Location: login.php');
    exit;
}

// Process form submission (if any)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assume you have a method to update user details
    $member->update($_POST['username'], $_POST['email']);
    // Redirect to profile or another page
    header('Location: profile.php');
    exit;
}

// Get user information
$username = $member->get('username') ?: 'Guest';
$email = $member->get('email') ?: 'Not provided';
?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Settings</h1>
    <form method="POST" class="card bg-base-100 shadow-md p-4">
        <div class="mb-4">
            <label for="username" class="block">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" class="input" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" class="input" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
