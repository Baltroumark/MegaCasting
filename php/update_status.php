<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'auteur') {
    header('Location: login.php');
    exit;
}

if (
    isset($_POST['application_id'], $_POST['status']) &&
    in_array($_POST['status'], ['accepte', 'refuse'])
) {
    $application_id = (int)$_POST['application_id'];
    $status = $_POST['status'];

    // Vérifier que l'auteur est bien propriétaire du casting lié à cette candidature
    $stmt = $pdo->prepare("
        SELECT c.user_id
        FROM applications a
        JOIN castings c ON a.casting_id = c.id
        WHERE a.id = ?
    ");
    $stmt->execute([$application_id]);
    $casting = $stmt->fetch();

    if ($casting && $casting['user_id'] == $_SESSION['user_id']) {
        $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE id = ?");
        $stmt->execute([$status, $application_id]);
    }
}

header('Location: manage_applications.php');
exit;
?>
