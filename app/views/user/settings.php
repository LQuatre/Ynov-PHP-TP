<?php

if (!$member->isLogged()) {
    header('Location: login');
    exit;
}

// Process form submission (if any)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assume you have a method to update user details
    $member->update($_POST['username'], $_POST['email'], $_POST['firstname'], $_POST['lastname']);
    // Redirect to profile or another page
    header('Location: profile');
    exit;
}

// Get user information
$username = $member->get('username') ?: 'Guest';
$email = $member->get('email') ?: 'Not provided';
$firstname = $member->get('firstname') ?: 'Not provided';
$lastname = $member->get('lastname') ?: 'Not provided';
?>

<div class="hero bg-base-200 min-h-screen pt-12">
    <!-- Affiché seulement sur desktop (taille md et plus) -->
    <div class="hidden md:block w-2/6">
        <div class="hero-content text-center">
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">Settings</h1>
                <form method="POST" class="card bg-base-100 shadow-md p-8">
                    <div class="mb-8">
                        <label for="firstname" class="block mb-2">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($firstname) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <div class="mb-8">
                        <label for="lastname" class="block mb-2">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($lastname) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <div class="mb-8">
                        <label for="username" class="block mb-2">Username</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <div class="mb-8">
                        <label for="email" class="block mb-2">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Affiché seulement sur mobile (taille inférieure à md) -->
    <div class="block md:hidden w-11/12">
        <div class="hero-content text-center">
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4">Settings</h1>
                <form method="POST" class="card bg-base-100 shadow-md p-4">
                    <div class="mb-6">
                        <label for="firstname" class="block mb-2">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($firstname) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <div class="mb-6">
                        <label for="lastname" class="block mb-2">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($lastname) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <div class="mb-6">
                        <label for="username" class="block mb-2">Username</label>
                        <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" class="input input-bordered w-full max-w-xs" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
