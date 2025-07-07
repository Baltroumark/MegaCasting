<?php
session_start();
require_once 'db.php';

$message = '';

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    header('Location: ' . ($_SESSION['role'] === 'auteur' ? 'author_dashboard.php' : 'user_dashboard.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $message = "Merci de remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            header('Location: ' . ($user['role'] === 'auteur' ? 'author_dashboard.php' : 'user_dashboard.php'));
            exit;
        } else {
            $message = "Identifiants incorrects.";
        }
    }
}

include '../views/login_view.php';
?>
