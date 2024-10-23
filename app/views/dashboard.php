<?php

// Get user information
$username = $member->get('username') ?: 'Guest';
$email = $member->get('email') ?: 'Not provided'; // Fallback if email not set

?>

<div class="bg-base-200 min-h-screen pt-12 flex items-start justify-center">
    <div class="hero-content text-center">
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Welcome, <?= htmlspecialchars($username) ?>!</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="card bg-base-100 shadow-md p-4">
                    <h2 class="text-xl font-semibold">Profile</h2>
                    <p>Email: <?= htmlspecialchars($email) ?></p>
                    <a href="/profile" class="btn btn-ghost mt-2">View Profile</a>
                </div>
                <!-- <div class="card bg-base-100 shadow-md p-4">
                    <h2 class="text-xl font-semibold">Settings</h2>
                    <p>Manage your account settings.</p>
                    <a href="/settings" class="btn btn-ghost mt-2">Settings</a>
                </div> -->
                <div class="card bg-base-100 shadow-md p-4">
                    <h2 class="text-xl font-semibold">Recent Activity</h2>
                    <p>No recent activity found.</p>
                    <a href="/activity" class="btn btn-ghost mt-2">View Activity</a>
                </div>
                <div class="card bg-base-100 shadow-md p-4">
                    <h2 class="text-xl font-semibold">CVs</h2>
                    <p>Manage your CVs.</p>
                    <a href="/cv" class="btn btn-ghost mt-2">View CVs</a>
                </div>
            </div>
        </div>
    </div>
</div>
