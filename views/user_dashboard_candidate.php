<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Candidat - MegaCasting</title>
    <link rel="stylesheet" href="../css/dashboard_candidate.css" />
</head>
<body>
<div class="container">
    <h1>Bienvenue, <?=htmlspecialchars($_SESSION['username'])?></h1>
    <nav>
        <a href="../php/logout.php">Déconnexion</a>
    </nav>


    <?php if ($message){
        echo '<div class=\"message'.strpos($message, 'succès') !== false ? 'success' : 'error'.'>';
        echo htmlspecialchars($message);
        echo '</div>';

    }
    ?>
    <h2>Castings ouverts</h2>
    <?php if (count($castings) === 0){
        echo '<p>Aucun casting ouvert actuellement.</p>';
    } else {
        echo'<table><thead><tr>';
        echo'<th>Titre</th>';
        echo'<th>Description</th>';
        echo'<th>Date Début</th>';
        echo'<th>Date Fin</th>';
        echo'<th>Action</th>';
        echo'</tr></thead><tbody>';
        foreach ($castings as $casting){
            echo '<tr>';
            echo '<td>'.$casting['titre'].'</td>';
            echo '<td>'.$casting['description'].'</td>';
            echo '<td>'.$casting['date_debut'].'</td>';
            echo '<td>'.$casting['date_fin'].'</td>';
            echo '<td>';
            echo '<form method="POST" action="">';
            echo "<input type=\"hidden\" name=\"casting_id\" value=\"".(int)$casting['id'].'">';
            echo '<input type="submit" value="Postuler">';
            echo '</form></td></tr>';
        }
        echo '</tbody></table>';
    }
    echo '<h2>Mes candidatures</h2>';
    if (count($applications) === 0){
        echo "<p>Vous n'avez postuler à aucun casting.</p>";
    } else {
        echo '<table><thead><tr>';
        echo '<th>Casting</th>';
        echo '<th>Statut</th>';
        echo '<th>Date de candidature</th>';
        echo '</tr></thead>';
        echo '<tbody>';
        foreach ($applications as $app){
            echo '<tr>';
            echo '<td>'.$app['titre'].'</td>';
            echo '<td>'.$app['status'].'</td>';
            echo '<td>'.$app['applied_at'].'</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } ?>
</div>
</body>
</html>
