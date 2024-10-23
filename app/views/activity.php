<?php

if (!$member->isLogged()) {
    header('Location: login.php');
    exit;
}

// Dummy activity data, replace with actual data fetching
$activities = [
    'Logged in',
    'Updated profile settings',
    'Logged out',
];

?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Recent Activity</h1>
    <div class="card bg-base-100 shadow-md p-4">
        <h2 class="text-xl font-semibold">Your Activity</h2>
        <ul>
            <?php if (empty($activities)): ?>
                <li>No recent activity found.</li>
            <?php else: ?>
                <?php foreach ($activities as $activity): ?>
                    <li><?= htmlspecialchars($activity) ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
