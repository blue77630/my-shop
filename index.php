<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Valorant Shop</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <h1>Valorant Shop</h1>
        <p>Bienvenue sur la boutique Valorant !</p>
    </header>
    <nav>
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
            <a href="admin.php">Admin</a>
        <?php endif; ?>
        <a href="logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="signup.php">Inscription</a>
        <a href="signin.php">Connexion</a>
    <?php endif; ?>
    </nav>
    <section class="products">
        <div class="product">
            <img src="images/elderflame-vandal-dark-ingame_orig.jpg" alt="Vandal Skin">
            <h3>Vandal Elderflame</h3>
            <p>Un skin mythique pour la Vandal, avec effets de feu et animations uniques.</p>
            <div class="price">25€</div>
            <button>Ajouter au panier</button>
        </div>
        <div class="product">
            <img src="images/Valorant-Glitchpop-Collection-Operator-Red-Variant.jpg" alt="Operator Skin">
            <h3>Operator Glitchpop</h3>
            <p>Un skin cyberpunk pour l'Operator, avec effets lumineux et sonores.</p>
            <div class="price">30€</div>
            <button>Ajouter au panier</button>
        </div>
        <div class="product">
            <img src="images/Valorant-Prime-2-Collection-Knife-HD.png" alt="Melee Skin">
            <h3>Couteau Prime</h3>
            <p>Le couteau Prime, élégant et lumineux, pour briller en fin de round.</p>
            <div class="price">15€</div>
            <button>Ajouter au panier</button>
        </div>
    </section>
</body>
</html>