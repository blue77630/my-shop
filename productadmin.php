<?php
require_once 'connection.php';

//** Ajouter un produit */
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $image = trim($_POST['image']);
    if ($name && $description && $price && $image) {
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $image]);
    }
}

//** Supprimer un produit */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

//** Modifier un produit */
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $image = trim($_POST['image']);
    if ($name && $description && $price && $image) {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $description, $price, $image, $id]);
    }
}

//** Récupérer tous les produits */
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<h2>Produits</h2>
<form method="post">
    <input type="text" name="name" placeholder="Nom du produit" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="number" step="0.01" name="price" placeholder="Prix" required>
    <input type="text" name="image" placeholder="URL de l'image" required>
    <button type="submit" name="add">Ajouter</button>
</form>
<table>
    <tr><th>ID</th><th>Nom</th><th>Description</th><th>Prix</th><th>Image</th><th>Actions</th></tr>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($p['name']) ?>">
            </td>
            <td>
                    <input type="text" name="description" value="<?= htmlspecialchars($p['description']) ?>">
            </td>
            <td>
                    <input type="number" step="0.01" name="price" value="<?= $p['price'] ?>">
            </td>
            <td>
                    <input type="text" name="image" value="<?= htmlspecialchars($p['image']) ?>">
            </td>
            <td>
                    <button type="submit" name="edit">Modifier</button>
                </form>
                <a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>