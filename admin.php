<?php
session_start();
if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit;
}

$menu = $_GET['menu'] ?? 'users';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Valorant Shop</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <h1>Admin - Valorant Shop</h1>
        <nav>
            <a href="index.php">Retour à la boutique</a>
            <a href="logout.php">Déconnexion</a>
        </nav>
    </header>
    <div class="admin-nav">
        <a href="?menu=users" class="<?= $menu === 'users' ? 'active' : '' ?>">Utilisateurs</a>
        <a href="?menu=products" class="<?= $menu === 'products' ? 'active' : '' ?>">Produits</a>
        <a href="?menu=categories" class="<?= $menu === 'categories' ? 'active' : '' ?>">Catégories</a>
    </div>
<div class="admin-content">
    <?php
    if ($menu === 'users') {
        include 'usersadmin.php';
    } elseif ($menu === 'products') {
        include 'productadmin.php';
    } elseif ($menu === 'categories') {
        include 'categoriesadmin.php';
    } else {
        echo "<p>Menu inconnu.</p>";
    }
    ?>
</body>
</html>