<?php
var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion / Inscription</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/auth.css" />
    <script src="../js/form.js"></script>
</head>
<body>
<div class="container">

    <form method="post" action="">
        <h2>Connexion</h2>
        <?php if (isset($message) && isset($_POST['action']) && $_POST['action'] === 'login'): ?>
            <div class="message"><?=htmlspecialchars($message)?></div>
        <?php endif; ?>
        <input type="hidden" name="action" value="login" />
        <label for="email_login">Email</label>
        <input type="email" id="email_login" name="email" required />
        <label for="password_login">Mot de passe</label>
        <input type="password" id="password_login" name="password" required />
        <button type="submit">Se connecter</button>
    </form>

    <form method="post" action="">
        <h2>Inscription</h2>
        <?php if (isset($message) && isset($_POST['action']) && $_POST['action'] === 'register'): ?>
            <div class="message"><?=htmlspecialchars($message)?></div>
        <?php endif; ?>
        <input type="hidden" name="action" value="register" />
        <label for="email_reg">Email</label>
        <input type="email" id="email_reg" name="email" required />
        <label for="password_reg">Mot de passe</label>
        <input type="password" id="password_reg" name="password" required />
        <label for="role">Vous êtes :</label>
        <select name="role" id="role" required>
            <option value="">-- Choisissez --</option>
            <option value="candidat">Candidat</option>
            <option value="auteur">Auteur</option>
        </select>
        <button type="submit">S'inscrire</button>
    </form>

</div>
</body>
</html>
