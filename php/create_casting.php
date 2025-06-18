<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'director') {
    header("Location: ../views/auth_view.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $date_casting = $_POST['date_casting'];

    if (!$title || !$description || !$location || !$date_casting) {
        header("Location: ../views/create_casting.php?error=1");
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO castings (user_id, title, description, location, date_casting) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $description, $location, $date_casting]);

    header("Location: ../views/home.php?casting_created=1");
    exit();
}
?>
