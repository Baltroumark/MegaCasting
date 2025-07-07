<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des candidatures</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Gestion des candidatures reçues</h2>
    <?php if (empty($applications)): ?>
        <p>Aucune candidature reçue pour vos castings.</p>
    <?php else: ?>
        <?php foreach ($applications as $app): ?>
            <div class="card">
                <h3><?= htmlspecialchars($app['casting_titre']) ?></h3>
                <p><strong>Candidat :</strong> <?= htmlspecialchars($app['candidat']) ?></p>
                <p><strong>Date :</strong> <?= htmlspecialchars($app['applied_at']) ?></p>
                <p><strong>Statut :</strong> <?= htmlspecialchars($app['status']) ?></p>
                <?php if ($app['status'] === 'en_attente'): ?>
                    <form method="post" action="../php/update_status.php" style="display:inline;">
                        <input type="hidden" name="application_id" value="<?= (int)$app['application_id'] ?>">
                        <input type="hidden" name="status" value="accepte">
                        <button type="submit">Accepter</button>
                    </form>
                    <form method="post" action="../php/update_status.php" style="display:inline;">
                        <input type="hidden" name="application_id" value="<?= (int)$app['application_id'] ?>">
                        <input type="hidden" name="status" value="refuse">
                        <button type="submit">Refuser</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
