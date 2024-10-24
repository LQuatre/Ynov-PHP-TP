```
:::   ::: ::::    :::  ::::::::  :::     :::               :::::::::  :::    ::: :::::::::
:+:   :+: :+:+:   :+: :+:    :+: :+:     :+:               :+:    :+: :+:    :+: :+:    :+:
 +:+ +:+  :+:+:+  +:+ +:+    +:+ +:+     +:+               +:+    +:+ +:+    +:+ +:+    +:+
  +#++:   +#+ +:+ +#+ +#+    +:+ +#+     +:+ +#++:++#++:++ +#++:++#+  +#++:++#++ +#++:++#+
   +#+    +#+  +#+#+# +#+    +#+  +#+   +#+                +#+        +#+    +#+ +#+
   #+#    #+#   #+#+# #+#    #+#   #+#+#+#                 #+#        #+#    #+# #+#
   ###    ###    ####  ########      ###                   ###        ###    ### ###
```

# CV Creator

Ce projet est une application web qui permet aux utilisateurs de créer et de télécharger leur CV au format PDF.

## Technologies utilisées

- **SQL** : Pour la gestion de la base de données.
- **PHP** : Pour le backend de l'application.
- **JavaScript** : Pour les interactions côté client.
- **Composer** : Pour la gestion des dépendances PHP.

## Installation

1. Clonez le dépôt :
    ```bash
    git clone https://github.com/LQuatre/Ynov-PHP-TP.git
    cd Ynov-PHP-TP
    ```

2. Démarrer le docker-compose :
    ```bash
    cd docker
    docker-compose up -d
    ```

## Utilisation

1. Accédez à l'application via `http://localhost`.
2. Cliquez sur le bouton \`Create your CV\` pour commencer à créer votre CV.
3. Remplissez les informations nécessaires et téléchargez votre CV au format PDF.

## Contributeurs

- **Lucas DIOT** (LQuatre) - Développeur principal

## Data Model

### User

| Field | Type | Description |
| --- | --- | --- |
| id | int | Identifiant unique de l'utilisateur |
| firstname | string | Prénom de l'utilisateur |
| lastname | string | Nom de l'utilisateur |
| username | string | Nom d'utilisateur de l'utilisateur |j
| email | string | Adresse email de l'utilisateur |
| password | string | Mot de passe de l'utilisateur |
| created_at | datetime | Date de création de l'utilisateur |
   
### CV

| Field | Type | Description |
| --- | --- | --- |
| id | int | Identifiant unique du CV |
| user_id | int | Identifiant de l'utilisateur associé au CV |
| title | string | Titre du CV |
| description | string | Description du CV |
| skills | string | Compétences du CV |
| experience | string | Expérience du CV |
| education | string | Éducation du CV |

### Project

| Field | Type | Description |
| --- | --- | --- |
| id | int | Identifiant unique du projet |
| cv_id | int | Identifiant du CV associé au projet |
| title | string | Titre du projet |
| description | string | Description du projet |
| image | string | Image du projet |   
| link | string | Lien du projet |
| created_at | datetime | Date de création du projet |

## Routes

### Home

- **GET** `/` : Affiche la page d'accueil.
- **GET** `/about` : Affiche la page "A propos".
- **GET** `/contact` : Affiche la page de contact.
- **POST** `/contact` : Envoie un email de contact.

### Authentification

- **GET** `/login` : Affiche le formulaire de connexion.
- **POST** `/login` : Authentifie l'utilisateur.
- **GET** `/register` : Affiche le formulaire d'inscription.
- **POST** `/register` : Enregistre un nouvel utilisateur.
- **GET** `/logout` : Déconnecte l'utilisateur.
- **GET** `/profile` : Affiche le profil de l'utilisateur.
- **GET** `/dashboard` : Affiche le tableau de bord de l'utilisateur.
- **GET** `/settings` : Affiche les paramètres de l'utilisateur.
- **POST** `/settings` : Modifie les paramètres de l'utilisateur.

### CV

- **GET** `/cv` : Affiche la liste des CV de l'utilisateur.
- **GET** `/cv/create` : Affiche le formulaire de création d'un CV.
- **POST** `/cv/create` : Enregistre un nouveau CV.
- **GET** `/cv/{id}` : Affiche le détail d'un CV.
- **GET** `/cv/edit/{id}` : Affiche le formulaire de modification d'un CV.
- **POST** `/cv/edit/{id}` : Modifie un CV. (Non implémenté)
- **GET** `/cv/delete/{id}` : Supprime un CV. (Non implémenté)
- **GET** `/cv/download/{id}` : Télécharge un CV au format PDF.

### Project

- **GET** `/project` : Affiche la liste des projets de l'utilisateur. (Non implémenté)
- **GET** `/project/{id}` : Affiche le détail d'un projet. (Non implémenté)
- **GET** `/project/create/` : Affiche le formulaire de création d'un projet.
- **POST** `/project/create/` : Enregistre un nouveau projet.
- **GET** `/project/edit/{id}` : Affiche le formulaire de modification d'un projet. (Non implémenté)
- **POST** `/project/edit/{id}` : Modifie un projet. (Non implémenté)
- **GET** `/project/delete/{id}` : Supprime un projet. (Non implémenté)

## Administration

- **GET** `/admin` : Affiche le tableau de bord de l'administrateur. 
- **GET** `/admin/users` : Affiche la liste des utilisateurs. (Non implémenté)
- **GET** `/admin/users/{id}` : Affiche le détail d'un utilisateur. (Non implémenté)
- **GET** `/admin/users/edit/{id}` : Affiche le formulaire de modification d'un utilisateur. (Non implémenté)
- **POST** `/admin/users/edit/{id}` : Modifie un utilisateur. (Non implémenté)
- **GET** `/admin/users/delete/{id}` : Supprime un utilisateur. (Non implémenté)

## Remerciements

Ce projet utilise le travail de [Bramus/router](https://github.com/bramus/router).
