<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'candidat') {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT a.status, c.*, p.title AS project_title, u.username AS auteur
    FROM applications a
    JOIN castings c ON a.casting_id = c.id
    JOIN projects p ON c.projet_id = p.id
    JOIN users u ON p.user_id = u.id
    WHERE a.user_id = ?
    ORDER BY c.date_debut DESC
");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();

include '../views/user_dashboard.php';
?>
