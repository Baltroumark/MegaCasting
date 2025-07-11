<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion / Inscription</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <?php if (!empty($auth_message)): ?>
        <div class="alert"><?= htmlspecialchars($auth_message) ?></div>
    <?php endif; ?>

    <h2>Connexion</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="login">
        <label>Email : <input type="email" name="email" required></label><br>
        <label>Mot de passe : <input type="password" name="password" required></label><br>
        <button type="submit">Se connecter</button>
    </form>

    <h2>Inscription</h2>
    <form method="post" action="">
        <input type="hidden" name="action" value="register">
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
</div>
</body>
</html>
