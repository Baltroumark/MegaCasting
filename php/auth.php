<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
session_destroy();
session_start();
require_once 'db.php';

$message = '';
$show_login_form = true;

if (!isset($pdo)) {
    die('Erreur : base de données non connectée.');
}

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'auteur') {
        header('Location: author_dashboard.php');
        exit;
    } else {
        header('Location: user_dashboard.php');
        exit;
    }
}

// Gestion des actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Action : Connexion
    if ($action === 'login') {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            $message = "Merci de remplir tous les champs correctement.";
        } else {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                session_regenerate_id(true); // Sécurisation
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                header('Location: ' . ($_SESSION['role'] === 'auteur' ? 'author_dashboard.php' : 'user_dashboard.php'));
                $_SESSION['username'] = $_POST['email'];
                exit;
            } else {
                $message = "Identifiants incorrects.";
            }
        }
    }

    // Action : Inscription
    elseif ($action === 'register') {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        if (!$email || !$password || !in_array($role, ['candidat', 'auteur'])) {
            $message = "Merci de remplir tous les champs correctement.";
        } else {
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $message = "Cet email est déjà utilisé.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO users (email, password_hash, role) VALUES (?, ?, ?)');
                $stmt->execute([$email, $hash, $role]);

                $message = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                $show_login_form = true;
            }
        }
    }
}

if ($show_login_form) {
    include '../views/auth_view.php';
}
?>