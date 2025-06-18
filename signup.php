<?php
require_once 'connection.php';
require_once 'User.php';

$message = '';
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $message = $user->register($username, $email, $password);

    if ($message === "Inscription réussie !") {
        session_start();
        $_SESSION['success'] = "Inscription réussie ! Connectez-vous.";
        header('Location: signin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inscription</h2>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Nom d'utilisateur : <input type="text" name="username" required></label><br>
        <label>Email : <input type="email" name="email" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>