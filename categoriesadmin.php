<?php
require_once 'connection.php';

//** Ajouter une catégorie */
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    if ($name) {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
    }
}

//** Supprimer une catégorie */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);
}

//** Modifier une catégorie */
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    if ($name) {
        $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);
    }
}

//** Récupérer toutes les catégories */
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<h2>Catégories</h2>
<form method="post">
    <input type="text" name="name" placeholder="Nom de la catégorie" required>
    <button type="submit" name="add">Ajouter</button>
</form>
<table>
    <tr><th>ID</th><th>Nom</th><th>Actions</th></tr>
    <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($cat['name']) ?>">
                    <button type="submit" name="edit">Modifier</button>
                </form>
            </td>
            <td>
                <a href="admin.php?menu=categories&delete=<?= $cat['id'] ?>" onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</a>
        </tr>
    <?php endforeach; ?>
</table>
