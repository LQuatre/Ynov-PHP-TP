<?php

if (!$member->isLogged()) {
    header('Location: /login');
    exit;
}

// Get user information
$username = $member->get('username') ?: 'Guest';
$email = $member->get('email') ?: 'Not provided';
$firstname = $member->get('firstname') ?: 'Not provided';
$lastname = $member->get('lastname') ?: 'Not provided';

?>
<div class="bg-base-200 min-h-screen pt-12 flex items-start justify-center">
    <!-- Affiché seulement sur desktop (taille md et plus) -->
    <div class="hidden md:block mb">
        <div class="hero-content text-center">
            <div class="container mx-auto p-4">
                <h1 class="text-3xl font-bold mb-6">Profile</h1>
                <div class="card bg-base-100 shadow-lg p-10 max-w-2xl mx-auto">
                    <h2 class="text-2xl font-semibold mb-4">User Information</h2>
                    <p class="mb-2"><strong>First Name:</strong> <?= htmlspecialchars($firstname) ?></p>
                    <p class="mb-4"><strong>Last Name:</strong> <?= htmlspecialchars($lastname) ?></p>
                    <p class="mb-2"><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
                    <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                    <a href="/user/settings" class="btn btn-secondary mt-4">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Affiché seulement sur mobile (taille inférieure à md) -->
    <div class="block md:hidden">
        <div class="hero-content text-center">
            <div class="container mx-auto p-4">
                <h1 class="text-3xl font-bold mb-6">Profile</h1>
                <div class="card bg-base-100 shadow-lg p-6 max-w-lg mx-auto">
                    <h2 class="text-xl font-semibold mb-4">User Info</h2>
                    <p class="mb-2"><strong>First Name:</strong> <?= htmlspecialchars($firstname) ?></p>
                    <p class="mb-2"><strong>Last Name:</strong> <?= htmlspecialchars($lastname) ?></p>
                    <p class="mb-2"><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
                    <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                    <a href="/settings" class="btn btn-secondary mt-4">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
