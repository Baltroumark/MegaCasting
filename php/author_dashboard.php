<?php
session_start();
require 'db.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'auteur') {
    header("Location: ../php/auth.php");
    exit;
}

$user_id = $_SESSION['id'];

$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../views/author_dashboard.php';
