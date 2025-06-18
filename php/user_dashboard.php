<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit;
}

require_once 'db.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role === 'auteur') {
    header('Location: manage_castings.php');
    exit;
}

$stmt = $pdo->prepare("
    SELECT c.*, cas.titre AS casting_titre, cas.date_debut, cas.date_fin
    FROM candidatures c
    JOIN castings cas ON c.casting_id = cas.id
    WHERE c.user_id = ?
    ORDER BY cas.date_debut DESC
");
$stmt->execute([$user_id]);
$candidatures = $stmt->fetchAll(PDO::FETCH_ASSOC);

include_once '../views/user_dashboard.php';
