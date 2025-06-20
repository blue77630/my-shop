<?php
require_once 'connection.php';
require_once 'User.php';

$message = '';
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $message = $user->login($username, $password);

    if ($message === "Connexion réussie !") {
        if ($_SESSION['is_admin']) {
            header('Location: admin.php');
        } else {
            header('Location: index.php');
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Connexion</h2>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Nom d'utilisateur : <input type="text" name="username" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>