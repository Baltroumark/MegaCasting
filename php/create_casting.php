<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'auteur') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ?");
$stmt->execute([$user_id]);
$projects = $stmt->fetchAll();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projet_id = $_POST['projet_id'];
    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];

    if ($projet_id && $titre && $description && $date_debut && $date_fin) {
        $stmt = $pdo->prepare("INSERT INTO castings (projet_id, user_id, titre, description, date_debut, date_fin) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$projet_id, $user_id, $titre, $description, $date_debut, $date_fin]);
        $message = "Casting créé avec succès.";
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}

include '../views/create_casting.php';
?>
