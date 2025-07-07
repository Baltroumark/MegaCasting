<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <?php if (!empty($message)): ?>
        <div class="alert"><?= $message ?></div>
    <?php endif; ?>

    <h2>Inscription</h2>
    <form method="post" action="">
        <label>Nom d'utilisateur : <input type="text" name="username" required></label><br>
        <label>Email : <input type="email" name="email" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <label>Rôle :
            <select name="role" required>
                <option value="">-- Sélectionner --</option>
                <option value="candidat">Candidat</option>
                <option value="auteur">Auteur</option>
            </select>
        </label><br>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
</div>
</body>
</html>
