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
    <?php
    if (isset($_GET['success'])) {
        echo '<div class="alert success">Votre candidature a bien été prise en compte.</div>';
    } elseif (isset($_GET['already_applied'])) {
        echo '<div class="alert warning">Vous avez déjà postulé à ce casting.</div>';
    } elseif (isset($_GET['error'])) {
        echo '<div class="alert error">Erreur lors de la candidature.</div>';
    }
    ?>
    <?php if (!empty($castings)): ?>
        <?php foreach ($castings as $casting): ?>
            <div class="card">
                <h3><?= htmlspecialchars($casting['titre']) ?></h3>
                <p><strong>Date :</strong> <?= htmlspecialchars($casting['date_debut']) ?> au <?= htmlspecialchars($casting['date_fin']) ?></p>
                <p><?= nl2br(htmlspecialchars($casting['description'])) ?></p>
                <p><em>Posté par <?= htmlspecialchars($casting['director']) ?></em></p>
                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'candidat'): ?>
                    <form action="../php/apply_casting.php" method="post">
                        <input type="hidden" name="casting_id" value="<?= htmlspecialchars($casting['id']) ?>">
                        <button type="submit">S'inscrire</button>
                    </form>
                <?php elseif (!isset($_SESSION['user_id'])): ?>
                    <p><a href="login.php">Connecte-toi</a> pour postuler</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun casting disponible pour le moment.</p>
    <?php endif; ?>
</div>
</body>
</html>
