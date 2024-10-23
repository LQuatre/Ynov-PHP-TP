<?php
require_once __DIR__ . '/../includes/classes/member.php';
require_once __DIR__ . '/../includes/functions.php';

use class\Member;

$member = new Member();

if (!$member->isLogged()) {
    header('Location: login.php');
    exit;
}

// Get user information
$username = $member->get('username') ?: 'Guest';
$email = $member->get('email') ?: 'Not provided';

?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Profile</h1>
    <div class="card bg-base-100 shadow-md p-4">
        <h2 class="text-xl font-semibold">User Information</h2>
        <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <a href="/settings" class="btn btn-secondary mt-2">Edit Profile</a>
    </div>
</div>
