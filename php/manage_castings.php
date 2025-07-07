<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'auteur') {
    header("Location: ../views/auth_view.php");
    exit;
}

require_once 'db.php';

$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'create') {
        $titre = trim($_POST['titre']);
        $description = trim($_POST['description']);
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        $projet_id = $_POST['projet_id'];

        if ($titre && $description && $date_debut && $date_fin && $projet_id) {
            $stmt = $pdo->prepare("INSERT INTO castings (projet_id, titre, description, date_debut, date_fin) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$projet_id, $titre, $description, $date_debut, $date_fin]);
            $message = "Casting créé avec succès.";
        } else {
            $message = "Tous les champs sont obligatoires.";
        }
    }
}

$stmtProjets = $pdo->prepare("SELECT * FROM projects WHERE user_id = ?");
$stmtProjets->execute([$user_id]);
$projets = $stmtProjets->fetchAll(PDO::FETCH_ASSOC);

$stmtCastings = $pdo->prepare("
    SELECT c.*, p.title as project_title 
    FROM castings c
    JOIN projects p ON c.projet_id = p.id
    WHERE p.user_id = ?
    ORDER BY c.date_debut DESC
");
$stmtCastings->execute([$user_id]);
$castings = $stmtCastings->fetchAll(PDO::FETCH_ASSOC);
include_once '../views/manage_castings.php';
