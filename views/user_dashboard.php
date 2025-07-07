<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Mon espace candidat - MegaCasting</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<div class="container">
    <h1>Bonjour <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <a href="../php/logout.php">Déconnexion</a>
    <h2>Mes candidatures</h2>
    <?php if (empty($applications)): ?>
        <p>Vous n'avez pas encore postulé pour un casting.</p>
        <a href="../php/castings_list.php">Voir les castings disponibles</a>
    <?php else: ?>
        <?php foreach ($applications as $app): ?>
            <div class="card">
                <h3><?= htmlspecialchars($app['titre']) ?></h3>
                <p><strong>Projet :</strong> <?= htmlspecialchars($app['project_title']) ?></p>
                <p><strong>Auteur :</strong> <?= htmlspecialchars($app['auteur']) ?></p>
                <p><strong>Date casting :</strong> <?= htmlspecialchars($app['date_debut']) ?> au <?= htmlspecialchars($app['date_fin']) ?></p>
                <p><strong>Statut :</strong>
                    <?php
                    switch ($app['status']) {
                        case 'en_attente': echo 'En attente'; break;
                        case 'accepte': echo 'Accepté'; break;
                        case 'refuse': echo 'Refusé'; break;
                    }
                    ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
