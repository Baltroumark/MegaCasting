<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'auteur') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre']);
    $description = trim($_POST['description']);

    if ($titre && $description) {
        $stmt = $pdo->prepare("INSERT INTO projects (user_id, title, description) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $titre, $description]);
        $message = "Projet créé avec succès.";
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}

include_once '../views/create_project.php';
?>
