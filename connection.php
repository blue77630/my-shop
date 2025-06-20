<?php
$localhost = 'localhost';
$db = 'my_shop';
$user = 'blue';
$password = '2006';

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}