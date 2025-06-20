<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($username, $email, $password)
    {
        if (empty($username) || empty($email) || empty($password)) {
            return "Tous les champs sont obligatoires.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Email invalide.";
        }

        //**Vérifie si l'utilisateur existe déjà*/
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            return "Nom d'utilisateur ou email déjà utilisé.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //** Insertion dans la base */
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email, admin) VALUES (?, ?, ?, 0)");
        if ($stmt->execute([$username, $hashedPassword, $email])) {
            return "Inscription réussie !";
        } else {
            return "Erreur lors de l'inscription.";
        }
    }

    public function login($username, $password)
    {
        if (empty($username) || empty($password)) {
            return "Tous les champs sont obligatoires.";
        }

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['is_admin'] = $user['admin'] ?? 0;
            return "Connexion réussie !";
        } else {
            return "Identifiants incorrects.";
        }
    }
}
