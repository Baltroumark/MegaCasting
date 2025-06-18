<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container" style="flex-direction: column; align-items: center;">
    <div class="card">
        <h1>Bienvenue, <?= htmlspecialchars($_SESSION['username']) ?> !</h1>
        <p>Ceci est votre page d’accueil du réseau social.</p>
        <a href="../php/logout.php">
            <button>Déconnexion</button>
        </a>
    </div>
</div>
</body>
</html>
