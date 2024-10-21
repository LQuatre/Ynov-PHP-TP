<?php

return [
    'db' => [
        'host' => 'db',
        'db' => 'cv_db',
        'user' => 'root',
        'pass' => 'root',
        'port' => '3306'
    ],
    'default_page' => 'home',
    'views' => [
        'home' => [
            'file' => 'home.php',
            'urlPath' => ['/', '/home'],
            'path' => '/../app/views/home.php',
            'title' => 'Accueil',
            'protected' => false,
        ],
        'login' => [
            'file' => 'login.php',
            'urlPath' => ['/login', '/connexion'],
            'path' => '/../app/views/login.php',
            'title' => 'Connexion',
            'protected' => false, // Il faut être connecté pour accéder à la page
        ],
        'register' => [
            'file' => 'signup.php',
            'urlPath' => ['/signup', '/inscription'],
            'path' => '/../app/views/signup.php',
            'title' => 'Inscription',
            'protected' => false,
        ],
        'cv' => [
            'file' => 'cv.php',
            'urlPath' => ['/cv', '/cv/'],
            'path' => '/../app/views/cv.php',
            'title' => 'CV',
            'protected' => false,
        ],
        'cv/create' => [
            'file' => 'cv_create.php',
            'urlPath' => ['/cv/create', '/cv/creer'],
            'path' => '/../app/views/cv_create.php',
            'title' => 'Créer un CV',
            'protected' => true,
        ],
        'cv/edit' => [
            'file' => 'cv_edit.php',
            'urlPath' => ['/cv/edit', '/cv/editer'],
            'path' => '/../app/views/cv_edit.php',
            'title' => 'Editer un CV',
            'protected' => true,
        ],
        'cv/delete' => [
            'file' => 'cv_delete.php',
            'urlPath' => ['/cv/delete', '/cv/supprimer'],
            'path' => '/../app/views/cv_delete.php',
            'title' => 'Supprimer un CV',
            'protected' => true,
        ],
        '404' => [
            'file' => '404.php',
            'urlPath' => ['/404'],
            'path' => '/../app/views/404.php',
            'title' => 'Page non trouvée',
            'protected' => false,
        ]
    ]
];