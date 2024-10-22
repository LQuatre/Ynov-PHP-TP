<?php

if (!$member->isLogged()) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}

// Get user information
$username = $member->get('pseudo') ?: 'Guest'; // Fallback to 'Guest' if not set

?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Welcome, <?= htmlspecialchars($member['username']) ?>!</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-xl font-semibold">Profile</h2>
            <p>Email: <?= htmlspecialchars($member['email']) ?></p>
            <a href="/profile" class="btn btn-primary mt-2">View Profile</a>
        </div>
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-xl font-semibold">Settings</h2>
            <p>Manage your account settings.</p>
            <a href="/settings" class="btn btn-secondary mt-2">Settings</a>
        </div>
        <div class="card bg-base-100 shadow-md p-4">
            <h2 class="text-xl font-semibold">Recent Activity</h2>
            <p>No recent activity found.</p>
            <a href="/activity" class="btn btn-accent mt-2">View Activity</a>
        </div>
    </div>
</div>