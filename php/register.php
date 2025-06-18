<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        header("Location: ../views/auth.html?error=password");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");

    try {
        $stmt->execute([$username, $email, $password_hash]);
        header("Location: ../views/auth.html?success=1");
    } catch (PDOException $e) {
        header("Location: ../views/auth.html?error=duplicate");
    }
}
?>
