<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'candidat') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_POST['casting_id']) || !is_numeric($_POST['casting_id']) || $_POST['casting_id'] <= 0) {
    header("Location: ../views/castings_list.php");
    exit();
}
$casting_id = (int)$_POST['casting_id'];

$stmt = $pdo->prepare("SELECT id FROM castings WHERE id = ?");
$stmt->execute([$casting_id]);
if (!$stmt->fetch()) {
    header("Location: ../views/castings_list.php?error=casting_not_found");
    exit();
}

$stmt = $pdo->prepare("SELECT 1 FROM applications WHERE user_id = ? AND casting_id = ?");
$stmt->execute([$user_id, $casting_id]);
if ($stmt->fetch()) {
    header("Location: ../views/castings_list.php?already_applied=1");
    exit();
}

$stmt = $pdo->prepare("INSERT INTO applications (user_id, casting_id) VALUES (?, ?)");
$stmt->execute([$user_id, $casting_id]);

header("Location: ../views/castings_list.php?success=1");
exit();
?>
