<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Mon espace auteur - MegaCasting</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<div class="container">
    <h1>Bonjour <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <a href="../php/logout.php">Déconnexion</a>

    <h2>Mes projets</h2>
    <a href="../php/create_project.php" class="btn">Créer un nouveau projet</a>

    <?php if (empty($projects)): ?>
        <p>Aucun projet de créé</p>
    <?php else: ?>
        <?php foreach ($projects as $proj): ?>
            <div class="card">
                <h3><?= htmlspecialchars($proj['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($proj['description'])) ?></p>
                <a href="manage_castings.php?project_id=<?= intval($proj['id']) ?>" class="btn">Gérer les castings</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
