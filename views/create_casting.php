<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un casting</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Créer un casting</h2>
        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <label>Projet :
                <select name="projet_id" required>
                    <option value="">-- Sélectionner un projet --</option>
                    <?php foreach ($projects as $proj): ?>
                        <option value="<?= $proj['id'] ?>"><?= htmlspecialchars($proj['title']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label><br>
            <input type="text" name="titre" placeholder="Titre du casting" required>
            <textarea name="description" placeholder="Description du projet" rows="5" required></textarea>
            <input type="date" name="date_debut" required>
            <input type="date" name="date_fin" required>
            <button type="submit">Publier le casting</button>
        </form>
    </div>
</div>
</body>
</html>
