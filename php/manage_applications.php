<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'auteur') {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT a.id AS application_id, a.status, a.applied_at, u.username AS candidat, c.titre AS casting_titre
    FROM applications a
    JOIN castings c ON a.casting_id = c.id
    JOIN users u ON a.user_id = u.id
    WHERE c.user_id = ?
    ORDER BY a.applied_at DESC
");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();

include '../views/manage_applications.php';
?>
