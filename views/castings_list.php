<?php
session_start();
require '../php/db.php';

$stmt = $pdo->query("SELECT castings.*, users.username AS director FROM castings JOIN users ON castings.user_id = users.id ORDER BY date_casting DESC");
$castings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Castings disponibles</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Castings ouverts</h2>
    <?php foreach ($castings as $casting){
        echo '<div class="card">';
        echo '<h3>'.htmlspecialchars($casting['title']).'</h3>';
        echo '<p><strong>Date :</strong>'.htmlspecialchars($casting['date_casting']).'</p>';
        echo '<p><strong>Lieu :</strong>'.htmlspecialchars($casting['location']).'</p>';
        echo '<p>'.nl2br(htmlspecialchars($casting['description'])).'</p>';
        echo '<p><em>Posté par'.htmlspecialchars($casting['director']).'</em></p>';
        if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user') {
            echo '<form action="../php/apply_casting.php" method="post">';
            echo htmlspecialchars('<input type="hidden" name="casting_id" value="'.$casting['id'].'">');
            echo "<button type=\"submit\">S'inscrire</button>";
            echo '</form>';
        } elseif (!isset($_SESSION['user_id'])){
            echo '<p><a href="auth_view.php">Connecte-toi</a> pour postuler</p>';
        }
        echo '</div>';
    }
    ?>
</div>
</body>
</html>
