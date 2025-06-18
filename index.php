<?php
session_start();
$message = '';
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'auteur') {
        header("Location: php/author_dashboard.php");
    } else {
        header("Location: php/user_dashboard.php");
    }
    exit;
} else {
    header("Location: php/auth.php");
    exit;
}
