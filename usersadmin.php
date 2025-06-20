<?php
require_once 'connection.php';

//** Ajouter un utilisateur */
if (isset($_POST['add'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $admin = isset($_POST['admin']) ? 1 : 0;
    if ($username && $email && $_POST['password']) {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, admin) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $admin]);
    }
}

//** Supprimer un utilisateur */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

//** Modifier un utilisateur (sauf mot de passe) */
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $admin = isset($_POST['admin']) ? 1 : 0;
    if ($username && $email) {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, admin = ? WHERE id = ?");
        $stmt->execute([$username, $email, $admin, $id]);
    }
}

//** Récupérer tous les utilisateurs */
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<h2>Utilisateurs</h2>
<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <label><input type="checkbox" name="admin"> Admin</label>
    <button type="submit" name="add">Ajouter</button>
</form>
<table>
    <tr><th>ID</th><th>Nom</th><th>Email</th><th>Admin</th><th>Actions</th></tr>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                    <input type="text" name="username" value="<?= htmlspecialchars($u['username']) ?>">
            </td>
            <td>
                    <input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>">
            </td>
            <td>
                    <input type="checkbox" name="admin" <?= $u['admin'] ? 'checked' : '' ?>>
            </td>
            <td>
                    <button type="submit" name="edit">Modifier</button>
                </form>
                <a href="?delete=<?= $u['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>