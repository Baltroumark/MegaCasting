<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Mon espace candidat - MegaCasting</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<div class="container">
    <h1>Bonjour <?=htmlspecialchars($_SESSION['username'])?></h1>
    <a href="../php/logout.php">Déconnexion</a>
    <h2>Mes candidatures</h2>

    <?php if (empty($applications)){
        echo "<p>Vous n'avez pas encore postulé à un casting.</p>";
    } else {
        foreach ($applications as $app){
            echo '<div class="card">';
            echo '<h3>'.htmlspecialchars($app['title']).'</h3>';
            echo '<p><strong>Projet :</strong>'.htmlspecialchars($app['project_title']).'</p>';
            echo '<p><strong>Auteur :</strong>'.htmlspecialchars($app['auteur']).'</p>';
            echo '<p><strong>Date casting :</strong>'.htmlspecialchars($app['date_casting']).'</p>';
            echo '<p><strong>Lieu :</strong>'.htmlspecialchars($app['location']).'</p>';
            echo '<p><strong>Statut :</strong>';
            switch ($app['status']) {
                case 'en_attente':
                    echo 'En attente';
                    break;
                case 'accepte':
                    echo 'Accepté';
                    break;
                case 'refuse':
                    echo 'Refusé';
                    break;
            }

        }
    }
    ?>
</div>
</body>
</html>
