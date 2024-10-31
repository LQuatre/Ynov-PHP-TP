<?php

namespace class;

use PDO;

require('/app/fpdf/fpdf.php');

use FPDF;

/**
 * Cette classe va nous permettre de gérer la connexion d'un membre,
 * de vérifier la session et les cookies et enfin
 * d'accéder aux informations du membre courant.
 */
class Member
{
    /**
     * Grain de sel utilisé pour la création d'un hash de sécurité aux cookies
     *
     * @var string
     */
    private static $salt = '16kXI#g<:<p<j}wF@8OBP$q[';

    /**
     * Le visiteur est connecté. Par défaut, non
     *
     * @var bool
     */
    private $logged = false;

        /**
     * Le visiteur est administrateur. Par défaut, non
     * 
     * @var bool
     */
    private $admin = false;

    /**
     * Informations sur le membre connecté
     *
     * @var array
     */
    private $member = [];

    /**
     * Activities of the member
     *
     * @var array
     */
    private $activities = [];



    public mixed $cvs;
    public mixed $projects;

    public function __construct()
    {
        // Tente de récupérer le membre par la SESSION
        $this->getFromSession();

        // Tente de récupérer le membre par les COOKIES
        $this->getFromCookie();

        if ($this->isLogged()) {
            $this->getCVs($this->member['id']);
            $this->getProjects($this->member['id']);
        }
    }

    /**
     * Le visiteur est connecté ?
     *
     * @return bool
     */
    public function isLogged(): bool
    {
        return $this->logged;
    }

    public function isAdmin(): bool
    {
        return $this->get('role') === 'admin';
    }

    /**
     * Récupére une information sur le membre connecté
     *
     * @param string $key La clé à récupérer. Ex : pseudo, email, ...
     * @return mixed|null La valeur de la clé ou NULL s'il elle n'existe pas
     */
    public function get(string $key)
    {
        if ($this->isLogged() && array_key_exists($key, $this->member)) {
            return $this->member[$key];
        }

        return null;
    }

    public function update($username, $email, $firstname, $lastname): void
    {
        $query = getPdo()->prepare('UPDATE users SET email = :email, username = :username, firstname = :firstname, lastname = :lastname WHERE id = :id');
        $query->execute([
            'email' => $email,
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'id' => $this->get('id')
        ]);
        $this->addActivity('Mise à jour du profil');
    }

    /**
     * Méthode statique permettant de vérifier si un pseudo est déjà utilisé
     *
     * @param string $pseudo Le pseudo à vérifier
     * @return bool
     */
    public static function pseudoIsAlreadyTaken(string $pseudo): bool
    {
        $query = getPdo()->prepare('SELECT * FROM users WHERE pseudo = :pseudo LIMIT 1');
        $query->execute(['pseudo' => $pseudo]);

        return $query->fetch() !== false;
    }

    public static function crediIsAlreadyTaken(string $credits): bool
    {
        $query = getPdo()->prepare('SELECT * FROM users WHERE credits = :credits LIMIT 100');
        $query->execute(['credits' => $credits]);

        return $query->fetch() !== false;
    }

    /**
     * Méthode statique permettant de vérifier si un email est déjà utilisé
     *
     * @param string $email L'email à vérifier
     * @return bool
     */
    public static function emailIsAlreadyTaken(string $email): bool
    {
        $query = getPdo()->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $query->execute(['email' => $email]);

        return $query->fetch() !== false;
    }

    /**
     * Méthode statique permettant de créer une session depuis un
     * tableau d'information sur un membre
     *
     * @param array $infos
     */
    public static function createSession(array $infos): void
    {
        $_SESSION['id'] = $infos['id'];
        $_SESSION['pseudo'] = $infos['username'];
    }

    /**
     * Méthode statique permettant de créer les cookies de connexion automatique
     * depuis un tableau d'information sur un membre
     *
     * @param array $infos
     */
    public static function createCookie(array $infos): void
    {
        // Expiration du cookie dans 30 jours
        $duration = 60 * 60 * 24 * 30;
        $expiration = time() + $duration;

        // Provide default values for path and domain
        setcookie('member_id', $infos['id'], $expiration, '/', '', false, true);
        setcookie('member_hash', self::generateHash($infos), $expiration, '/', '', false, true);
    }


    /**
     * Méthode statique qui à partir des infos d'un membre et d'un grain de sel
     * va générer un hash unique pour la connexion automatique par cookie.
     * Si le grain de sel change, les cookies précédemment créés ne
     * fonctionneront plus.
     *
     * @param array $infos
     * @return string
     */
    protected static function generateHash(array $infos): string
    {
        // Explication : https://www.php.net/manual/fr/function.sha1.php
        return sha1($infos['id'] . $infos['username'] . self::$salt);
    }

    /**
     * Récupère un membre depuis ses infos de session
     */
    protected function getFromSession(): void
    {
        // Les variables de session existent
        if (! empty($_SESSION['id']) && ! empty($_SESSION['username'])) {
            $query = getPdo()->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
            $success = $query->execute(['id' => $_SESSION['id']]);

            // Le membre existe en BDD
            if ($success) {
                $this->member = $query->fetch();
                $this->logged = true;
            }
        }
    }

    /**
     * Récupère un membre depuis les infos de cookie
     */
    protected function getFromCookie(): void
    {
        $id = $_COOKIE['member_id'] ?? null;
        $hash = $_COOKIE['member_hash'] ?? null;

        // L'ID et le Hash existent dans les cookies
        if (! empty($id) && ! empty($hash)) {
            $query = getPdo()->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
            $success = $query->execute(['id' => $id]);
            $member = $query->fetch();

            // Le membre existe en BDD et le hash fourni est valide
            if ($success && $hash === self::generateHash($member)) {
                $this->member = $member;
                $this->logged = true;
            }
        }
    }

    private function getCVs($id): void
    {
        $query = getPdo()->prepare('SELECT * FROM cvs WHERE user_id = :user_id');
        $query->execute(['user_id' => $id]);
        $this->cvs = $query->fetchAll();
    }

    private function getProjects($id): void
    {
        $query = getPdo()->prepare('SELECT * FROM projects WHERE user_id = :user_id');
        $query->execute(['user_id' => $id]);
        $this->projects = $query->fetchAll();
    }

    public function register($email, $username, $password): bool|string
    {
        // Vérifier si l'email ou le nom d'utilisateur existe déjà
        $emailTaken = $this->emailIsAlreadyTaken($email);
        if ($emailTaken == true) {
            return "Cet email ou nom d'utilisateur est déjà utilisé.";
        }

        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer le nouvel utilisateur
        $query = getPdo()->prepare("INSERT INTO users (email, username, password) VALUES (:email, :username, :password)");
        $result = $query->execute([
            ':email' => $email,
            ':username' => $username,
            ':password' => $hashedPassword
        ]);
        if ($result) {
            return true;
        } else {
            return "Une erreur est survenue lors de l'inscription.";
        }
    }

    public function handleRegister($page, $member): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Validation simple
            if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
                $error = "Tous les champs sont requis.";
                header('Location: /signup?error=' . $error);
            } elseif ($password !== $confirm_password) {
                $error = "Les mots de passe ne correspondent pas.";
                header('Location: /signup?error=' . $error);
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Format d'email invalide.";
                header('Location: /signup?error=' . $error);
            } else {
                // Tentative d'inscription
                $result = $this->register($email, $username, $password);
                if ($result === true) {
                    // Redirection vers la page de connexion ou accueil
                    $this->addActivity('Inscription');
                    header('Location: /login');
                    exit;
                } else {
                    $error = $result; // Le message d'erreur retourné par la méthode register
                    header('Location: /signup?error=' . $error);
                }
            }
        }
    }

    public function login($email, $password): bool|string
    {
        // Récupérer l'utilisateur par son email
        $query = getPdo()->prepare("SELECT * FROM users WHERE (username=:email OR email=:email)");
        $query->execute(['email' => $email]);
        $member = $query->fetch();

        // Vérifier si l'utilisateur existe
        if ($member === false) {
            return "Cet email n'existe pas.";
        }

        // Vérifier le mot de passe
        if (!password_verify($password, $member['password'])) {
            return "Le mot de passe est incorrect.";
        }

        // Créer la session
        self::createSession($member);

        // Créer les cookies de connexion automatique
        self::createCookie($member);

        $this->addActivity('Création de session et cookies de connexion automatique');

        return true;
    }
    public function handleLogin($page, $member)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validate input
            if (empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
                
            }

            // Attempt to login
            $result = $this->login($email, $password);

            // Handle login result
            if ($result === true) {
                $this->addActivity('Connexion');
                header('Location: /user/dashboard');
                exit;
            } else {
                $error = $result; // Le message d'erreur retourné par la méthode register
                header('Location: /login?error=' . $error);
            }
        }
    }

    public function logout(): void
    {
        // Remove cookies
        setcookie('member_id', '', time() - 3600, '/', '', false, true);
        setcookie('member_hash', '', time() - 3600, '/', '', false, true);

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        $this->addActivity('Déconnexion');
        header('Location: /home');
        exit;
    }

    public function newCv($user_id, $email, $phone, $address, $education, $experience, $skills): bool|string
    {
        // Insert the new CV
        $query = getPdo()->prepare("INSERT INTO cvs (user_id, email, phone, address, education, experience, skills) VALUES (:user_id, :email, :phone, :address, :education, :experience, :skills)");
        $result = $query->execute([
            ':user_id' => $user_id,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address,
            ':education' => $education,
            ':experience' => $experience,
            ':skills' => $skills
        ]);
        if ($result) {
            return true;
        } else {
            return "Une erreur est survenue lors de la création du CV.";
        }
    }

    public function handleNewCv($page, $member): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $this->get('id');
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $education = $_POST['education'] ?? '';
            $experience = $_POST['experience'] ?? '';
            $skills = $_POST['skills'] ?? '';

            // Validate input
            if (empty($user_id) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^\+?[0-9\s\-]+$/', $phone) || empty($address) || empty($education) || empty($experience) || empty($skills)) {
                $error = "Veuillez remplir tous les champs correctement.";
                
                return;
            }

            // Attempt to create the CV
            $result = $this->newCv($user_id, $email, $phone, $address, $education, $experience, $skills);

            // Handle CV creation result
            if ($result === true) {
                $this->addActivity('Création d\'un CV');
                header('Location: /user/dashboard');
                exit;
            } else {
                print_r($result);
                $error = $result; // Le message d'erreur retourné par la méthode register
                header('Location: /cv/create?error=' . $error);
            }
        }
    }

    public function newProject($user_id, $title, $description, $link): bool|string
    {
        // Insert the new project
        $query = getPdo()->prepare("INSERT INTO projects (user_id, title, description, link) VALUES (:user_id, :title, :description, :link)");
        $result = $query->execute([
            ':user_id' => $user_id,
            ':title' => $title,
            ':description' => $description,
            ':link' => $link
        ]);
        if ($result) {
            return true;
        } else {
            return "Une erreur est survenue lors de la création du projet.";
        }
    }

    public function handleNewProject($page, $member): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $this->get('id');
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $link = $_POST['link'] ?? '';

            // Validate input
            if (empty($user_id) || empty($title) || empty($description) || empty($link)) {
                $error = "Veuillez remplir tous les champs correctement.";

                return;
            }

            // Attempt to create the project
            $result = $this->newProject($user_id, $title, $description, $link);

            // Handle project creation result
            if ($result === true) {
                $this->addActivity('Création d\'un nouveau projet : ' . $title);
                header('Location: /user/dashboard');
                exit;
            } else {
                print_r($result);
                $error = $result; // Le message d'erreur retourné par la méthode register
                header('Location: /project/create?error=' . $error);
            }
        }
    }

    public function addActivity(string $activity): void
    {
        $query = getPdo()->prepare('INSERT INTO activities (user_id, activity) VALUES (:user_id, :activity)');
        $query->execute([
            'user_id' => $this->get('id'),
            'activity' => $activity
        ]);
    }

    public function getActivities(): array
    {
        $query = getPdo()->prepare('SELECT activity FROM activities WHERE user_id = :user_id ORDER BY created_at DESC');
        $query->execute(['user_id' => $this->get('id')]);
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function generatePdf($cv): void
    {
        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();

// Set title
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'Curriculum Vitae', 0, 1, 'C');
        $pdf->Ln(5);

// Add Name Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Personal Information', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, 'Firstname: ' . $this->get('firstname'), 0, 1);
        $pdf->Cell(0, 8, 'Lastname: ' . $this->get('lastname'), 0, 1);
        $pdf->Cell(0, 8, 'Email: ' . $cv['email'], 0, 1);
        $pdf->Cell(0, 8, 'Phone: ' . $cv['phone'], 0, 1);
        $pdf->Cell(0, 8, 'Address: ' . $cv['address'], 0, 1);
        $pdf->Ln(5);

// Add Education Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Education', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, $cv['education']);
        $pdf->Ln(5);

// Add Experience Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Professional Experience', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, $cv['experience']);
        $pdf->Ln(5);

// Add Skills Section
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Skills', 0, 1);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 8, $cv['skills']);
        $pdf->Ln(5);

// Output the PDF
        $fullname = $this->get('firstname') . '_' . $this->get('lastname') . '_CV_' . $cv['id'];
        $pdf->Output('D', $fullname . '.pdf');
    }
}