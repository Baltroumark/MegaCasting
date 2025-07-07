<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Créer un Projet</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<div class="container">
    <h1>Créer un nouveau projet</h1>
    <?php if (!empty($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="titre">Titre :</label><br/>
        <input type="text" id="titre" name="titre" required><br/>
        <label for="description">Description :</label><br/>
        <textarea id="description" name="description" required></textarea><br/>
        <button type="submit">Créer le projet</button>
    </form>
</div>
</body>
</html>
