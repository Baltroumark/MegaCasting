<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'director') {
    header("Location: auth.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un casting</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container" style="flex-direction: column; align-items: center;">
    <div class="card">
        <h2>Créer un casting</h2>
        <form action="../php/create_casting.php" method="post">
            <input type="text" name="title" placeholder="Titre du casting" required>
            <textarea name="description" placeholder="Description du projet" rows="5" required></textarea>
            <input type="text" name="location" placeholder="Lieu" required>
            <input type="date" name="date_casting" required>
            <button type="submit">Publier le casting</button>
        </form>
    </div>
</div>
</body>
</html>
