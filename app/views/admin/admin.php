<?php

?>

<div class="h-screen flex flex-col justify-center overflow-hidden">
    <!-- Affiché seulement sur desktop (taille md et plus) -->
    <div class="hidden lg:block w-full p-6 m-auto bg-primary/10 rounded-md shadow-md ring-2 ring-gray-800/50 lg:max-w-xl">
        <h1 class="text-3xl font-bold text-center">Admin Dashboard</h1>
        <p class="text-center">Welcome to the admin panel. Here you can manage all the aspects of the application.</p>
        <ul class="mt-6 space-y-2">
            <li><a href="admin/manage/users" class="text-blue-500 hover:underline">Manage Users</a></li>
            <li><a href="admin/site/settings" class="text-blue-500 hover:underline">Site Settings</a></li>
        </ul>
    </div>

    <!-- Affiché seulement sur mobile (taille inférieure à lg) -->
    <div class="block lg:hidden w-full p-6 m-auto bg-primary/10 rounded-md shadow-md ring-2 ring-gray-800/50 lg:max-w-xl">
        <h1 class="text-2xl font-bold text-center">Admin Dashboard</h1>
        <p class="text-center">Welcome to the admin panel. Here you can manage all the aspects of the application.</p>
        <ul class="mt-6 space
        -y-2">
            <li><a href="admin/manage/users" class="text-blue-500 hover:underline">Manage Users</a></li>
            <li><a href="admin/site/settings" class="text-blue-500 hover:underline">Site Settings</a></li>
        </ul>
    </div>
</div>