<?php

return [
    'db' => [
        'db_host' => 'db',
        'db_name' => 'cv_db',
        'db_user' => 'root',
        'db_pass' => 'root',
        'db_port' => '3306'
    ],
    'default_page' => 'home',
    'views' => [
        'home' => [
            'file' => 'home.php',
            'urlPath' => ['/', '/home'],
            'path' => '/../app/views/home.php',
            'route' => '/../views/layout.php',
            'title' => 'Accueil',
            'method' => ['GET', 'POST'],
            'protected' => false,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'login' => [
            'file' => 'login.php',
            'urlPath' => ['/login', '/connexion'],
            'path' => '/../app/views/login.php',
            'route' => '/../views/layout.php',
            'title' => 'Connexion',
            'method' => ['GET', 'POST'],
            'protected' => false,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'logout' => [
            'file' => 'logout.php',
            'urlPath' => ['/logout', '/deconnexion'],
            'path' => '/../app/views/logout.php',
            'route' => '/../views/logout.php',
            'title' => 'Déconnexion',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'register' => [
            'file' => 'signup.php',
            'urlPath' => ['/signup', '/inscription'],
            'path' => '/../app/views/signup.php',
            'route' => '/../views/layout.php',
            'title' => 'Inscription',
            'method' => ['GET', 'POST'],
            'protected' => false,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'cv' => [
            'file' => 'cv.php',
            'urlPath' => ['/cv', '/cv/'],
            'path' => '/../app/views/cv.php',
            'route' => '/../views/layout.php',
            'title' => 'CV',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        '/cv/(\d+)'=> [
            'file' => 'cv_detail.php',
            'urlPath' => ['/cv/(\d+)'],
            'path' => '/../app/views/cv_detail.php',
            'route' => '/../views/layout.php',
            'title' => 'Détails du CV',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => ['id']
        ],
        'cv/download/' => [
            'file' => 'cv_download.php',
            'urlPath' => ['/cv/download'],
            'path' => '/../app/views/cv_download.php',
            'route' => '/../views/layout.php',
            'title' => 'Télécharger un CV',
            'method' => ['POST'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'cv/create' => [
            'file' => 'cv_create.php',
            'urlPath' => ['/cv/create', '/cv/creer'],
            'path' => '/../app/views/cv_create.php',
            'route' => '/../views/layout.php',
            'title' => 'Créer un CV',
            'method' => ['GET', 'POST'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'cv/edit' => [
            'file' => 'cv_edit.php',
            'urlPath' => ['/cv/edit', '/cv/editer'],
            'path' => '/../app/views/cv_edit.php',
            'route' => '/../views/layout.php',
            'title' => 'Editer un CV',
            'method' => ['GET', 'POST'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'cv/delete/(\d+)' => [
            'file' => 'cv_delete.php',
            'urlPath' => ['/cv/delete/(\d+)'],
            'path' => '/../app/views/cv_delete.php',
            'route' => '/../views/layout.php',
            'title' => 'Supprimer un CV',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => ['id']
        ],
        'project' => [
            'file' => 'project.php',
            'urlPath' => ['/project', '/projet'],
            'path' => '/../app/views/project.php',
            'route' => '/../views/layout.php',
            'title' => 'Projets',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        '/project/(\d+)' => [
            'file' => 'project_detail.php',
            'urlPath' => ['/project/(\d+)'],
            'path' => '/../app/views/project_detail.php',
            'route' => '/../views/layout.php',
            'title' => 'Détails du projet',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => ['id']
        ],
        'project/create' => [
            'file' => 'project_create.php',
            'urlPath' => ['/project/create', '/projet/creer'],
            'path' => '/../app/views/project_create.php',
            'route' => '/../views/layout.php',
            'title' => 'Créer un projet',
            'method' => ['GET', 'POST'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'project/edit' => [
            'file' => 'project_edit.php',
            'urlPath' => ['/project/edit', '/projet/editer'],
            'path' => '/../app/views/project_edit.php',
            'route' => '/../views/layout.php',
            'title' => 'Editer un projet',
            'method' => ['GET', 'POST'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'project/delete/(\d+)' => [
            'file' => 'project_delete.php',
            'urlPath' => ['/project/delete/(\d+)'],
            'path' => '/../app/views/project_delete.php',
            'route' => '/../views/layout.php',
            'title' => 'Supprimer un projet',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => ['id']
        ],
        'dashboard' => [
            'file' => 'dashboard.php',
            'urlPath' => ['/dashboard'],
            'path' => '/../app/views/dashboard.php',
            'route' => '/../views/layout.php',
            'title' => 'Tableau de bord',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'profile' => [
            'file' => 'profile.php',
            'urlPath' => ['/profile'],
            'path' => '/../app/views/profile.php',
            'route' => '/../views/layout.php',
            'title' => 'Profil',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'settings' => [
            'file' => 'settings.php',
            'urlPath' => ['/settings', '/parametres'],
            'path' => '/../app/views/settings.php',
            'route' => '/../views/layout.php',
            'title' => 'Paramètres',
            'method' => ['GET', 'POST'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'activity' => [
            'file' => 'activity.php',
            'urlPath' => ['/activity', '/activite'],
            'path' => '/../app/views/activity.php',
            'route' => '/../views/layout.php',
            'title' => 'Activité',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'about' => [
            'file' => 'about.php',
            'urlPath' => ['/about', '/a-propos'],
            'path' => '/../app/views/about.php',
            'route' => '/../views/layout.php',
            'title' => 'À propos',
            'method' => ['GET'],
            'protected' => false,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'contact' => [
            'file' => 'contact.php',
            'urlPath' => ['/contact'],
            'path' => '/../app/views/contact.php',
            'route' => '/../views/layout.php',
            'title' => 'Contact',
            'method' => ['GET', 'POST'],
            'protected' => false,
            'needToBeAdmin' => false,
            'params' => []
        ],
        'admin' => [
            'file' => 'admin.php',
            'urlPath' => ['/admin'],
            'path' => '/../app/views/admin.php',
            'route' => '/../views/layout.php',
            'title' => 'Admin',
            'method' => ['GET'],
            'protected' => true,
            'needToBeAdmin' => true,
            'params' => []
        ],
        'rickroll' => [
            'file' => 'rick.php',
            'urlPath' => ['/rickroll'],
            'path' => '/../app/views/rickroll.php',
            'route' => '/../views/layout.php',
            'title' => 'Rickroll',
            'method' => ['GET'],
            'protected' => false,
            'needToBeAdmin' => false,
            'params' => []
        ],
        '404' => [
            'file' => '404.php',
            'urlPath' => ['/404'],
            'path' => '/../app/views/404.php',
            'route' => '/../views/layout.php',
            'title' => 'Page non trouvée',
            'method' => ['GET'],
            'protected' => false,
            'needToBeAdmin' => false,
            'params' => []
        ]
    ]
];