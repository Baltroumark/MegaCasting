<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../views/auth.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$casting_id = intval($_POST['casting_id'] ?? 0);

// Vérifie que l'inscription n'existe pas déjà
$stmt = $pdo->prepare("SELECT 1 FROM casting_applications WHERE user_id = ? AND casting_id = ?");
$stmt->execute([$user_id, $casting_id]);

if ($stmt->fetch()) {
    header("Location: ../views/castings_list.php?already_applied=1");
    exit();
}

// Inscription
$stmt = $pdo->prepare("INSERT INTO casting_applications (user_id, casting_id) VALUES (?, ?)");
$stmt->execute([$user_id, $casting_id]);

header("Location: ../views/castings_list.php?success=1");
exit();
