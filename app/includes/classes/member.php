<?php

namespace class;

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
     * Informations sur le membre connecté
     *
     * @var array
     */
    private $member = [];

    public function __construct()
    {
        // Tente de récupérer le membre par la SESSION
        $this->getFromSession();

        // Tente de récupérer le membre par les COOKIES
        $this->getFromCookie();
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

    /**
     * Méthode statique permettant de vérifier si un pseudo est déjà utilisé
     *
     * @param string $pseudo Le pseudo à vérifier
     * @return bool
     */
    public static function pseudoIsAlreadyTaken(string $pseudo): bool
    {
        $query = getPdo()->prepare('SELECT * FROM membres WHERE pseudo = :pseudo LIMIT 1');
        $query->execute(['pseudo' => $pseudo]);

        return $query->fetch() !== false;
    }

    public static function crediIsAlreadyTaken(string $credits): bool
    {
        $query = getPdo()->prepare('SELECT * FROM membres WHERE credits = :credits LIMIT 100');
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
        $query = getPdo()->prepare('SELECT * FROM membres WHERE email = :email LIMIT 1');
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
            $query = getPdo()->prepare('SELECT * FROM membres WHERE id = :id LIMIT 1');
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
            $query = getPdo()->prepare('SELECT * FROM membres WHERE id = :id LIMIT 1');
            $success = $query->execute(['id' => $id]);
            $member = $query->fetch();

            // Le membre existe en BDD et le hash fourni est valide
            if ($success && $hash === self::generateHash($member)) {
                $this->member = $member;
                $this->logged = true;
            }
        }
    }

    public function register($email, $username, $password): bool|string
    {
        // Vérifier si l'email ou le nom d'utilisateur existe déjà
        $query = getPdo()->prepare("SELECT * FROM membres WHERE email = :email OR username = :username");
        $query->execute(['email' => $email, 'username' => $username]);
        if ($query->rowCount() > 0) {
            return "Cet email ou nom d'utilisateur est déjà utilisé.";
        }

        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer le nouvel utilisateur
        $query = getPdo()->prepare("INSERT INTO membres (email, username, password) VALUES (:email, :username, :password)");
        $result = $query->execute([
            'email' => $email,
            'username' => $username,
            'password' => $hashedPassword
        ]);

        if ($result) {
            return true;
        } else {
            return "Une erreur est survenue lors de l'inscription.";
        }
    }

    public function login($email, $password): bool|string
    {
        // Récupérer l'utilisateur par son email
        $query = getPdo()->prepare("SELECT * FROM membres WHERE email = :email");
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

        return true;
    }

    public  function logout(): void
    {
        // Supprimer les cookies
        setcookie('member_id', '', time() - 3600, '/', '', false, true);
        setcookie('member_hash', '', time() - 3600, '/', '', false, true);

        // Supprimer la session
        session_destroy();

        // Rediriger vers la page de connexion
        header('Location: /dashboard');
        exit;
    }
}