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

<div class="min-h-screen bg-base-200 flex flex-col items-center">
    <div class="w-full max-w-md mt-4 px-4">
        <div class="card w-full pt-12">
            <div class="card-body">
                <h1 class="text-xl font-bold text-center">Activity Log</h1>
                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ($activities as $activity) : ?>
                        <div class="card">
                            <div class="card-body">
                                <p class="text-sm"><?= $activity ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>