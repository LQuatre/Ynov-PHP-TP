<?php
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light'; // Récupérer le thème du cookie
?>
<!DOCTYPE html>
<html lang="en" data-theme="light"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header>
        <div class="navbar bg-base-100 absolute">
            <div class="navbar-start">
                <!-- Dropdown for mobile (hidden on larger screens) -->
                <div class="lg:hidden">
                    <div class="dropdown">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <ul
                        tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li><a href="/home">Homepage</a></li>
                        <?php if ($member->isLogged()): ?>
                            <li><a href="/dashboard">Dashboard</a></li>
                            <li><a href="/logout">Logout</a></li>
                        <?php else: ?>
                            <li><a href="/login">Login</a></li>
                            <li><a href="/signup">SignUp</a></li>
                        <?php endif; ?>
                        <li><a href="/about">About</a></li>
                    </ul>
                    </div>
                </div>
                <script>
                    // Cacher le dropdown si lg screen
                    document.addEventListener('DOMContentLoaded', function() {
                        const dropdown = document.querySelector('.dropdown');
                        if (window.matchMedia('(min-width: 1024px)').matches) {
                            dropdown.classList.add('hidden');
                        }
                    });
                </script>

                <!-- Navbar for desktop (hidden on smaller screens) -->
                <nav class="hidden lg:flex justify-between items-center bg-base-100">
                    <div class="flex space-x-4">
                        <a href="/home" class="btn btn-ghost">Homepage</a>
                        <a href="/about" class="btn btn-ghost">About</a>
                    </div>
                    <div>
                        <?php if ($member->isLogged()): ?>
                            <a href="/user/dashboard" class="btn btn-ghost">Dashboard</a>
                            <a href="/user/logout" class="btn btn-ghost">Logout</a>
                        <?php else: ?>
                            <a href="/login" class="btn btn-ghost">Login</a>
                            <a href="/signup" class="btn btn-ghost">SignUp</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
            <div class="navbar-center">
                <a href="/home" class="btn btn-ghost text-xl">UrPlatform</a>
            </div>
            <div class="navbar-end">
<!--                <button class="btn btn-ghost btn-circle">-->
<!--                    <svg-->
<!--                            xmlns="http://www.w3.org/2000/svg"-->
<!--                            class="h-5 w-5"-->
<!--                            fill="none"-->
<!--                            viewBox="0 0 24 24"-->
<!--                            stroke="currentColor">-->
<!--                        <path-->
<!--                                stroke-linecap="round"-->
<!--                                stroke-linejoin="round"-->
<!--                                stroke-width="2"-->
<!--                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />-->
<!--                    </svg>-->
<!--                </button>-->
<!--                <button class="btn btn-ghost btn-circle">-->
<!--                    <div class="indicator">-->
<!--                        <svg-->
<!--                                xmlns="http://www.w3.org/2000/svg"-->
<!--                                class="h-5 w-5"-->
<!--                                fill="none"-->
<!--                                viewBox="0 0 24 24"-->
<!--                                stroke="currentColor">-->
<!--                            <path-->
<!--                                    stroke-linecap="round"-->
<!--                                    stroke-linejoin="round"-->
<!--                                    stroke-width="2"-->
<!--                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />-->
<!--                        </svg>-->
<!--                        <span class="badge badge-xs badge-primary indicator-item"></span>-->
<!--                    </div>-->
<!--                </button>-->
                <label class="flex cursor-pointer gap-2">
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        <circle cx="12" cy="12" r="5" />
                        <path
                                d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
                    </svg>
                    <input type="checkbox" value="dark" class="toggle theme-controller" <?= $theme === 'dark' ? 'checked' : '' ?> />
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </label>
            </div>
        </div>
    </header>
    <main>
        <?php require_once __DIR__ . $page['path']; ?>
    </main>
    <footer class="footer footer-center bg-base-200 text-base-content rounded p-10">
        <nav class="grid grid-flow-col gap-4">
            <a href="contact" class="link link-hover">Contact</a>
        </nav>
        <nav>
            <div class="grid grid-flow-col gap-4">
                <a>
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="fill-current">
                        <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                    </svg>
                </a>
                <a>
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="fill-current">
                        <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                    </svg>
                </a>
                <a>
                    <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="fill-current">
                        <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                    </svg>
                </a>
            </div>
        </nav>
        <aside>
            <p>&copy; <?= date('Y') ?> - All rights reserved by LQuatre</p>
        </aside>
    </footer>
    <script>
        // Fonction pour mettre à jour le cookie
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        // Écouter les changements sur le theme-controller
        document.querySelector('.theme-controller').addEventListener('change', function() {
            const theme = this.checked ? 'dark' : 'light'; // Déterminer le thème
            setCookie('theme', theme, 30); // Sauvegarder le thème dans un cookie pour 30 jours
            document.documentElement.setAttribute('data-theme', theme); // Appliquer le thème en temps réel
        });
    </script>
</body>
</html>