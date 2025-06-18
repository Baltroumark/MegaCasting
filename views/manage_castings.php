<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Gestion des Castings</title>
  <link rel="stylesheet" href="../css/manage_castings.css" />
</head>
<body>
<div class="container">
  <h1>Gestion des Castings</h1>

  <?php if ($message): ?>
  <p><?=htmlspecialchars($message)?></p>
  <?php endif; ?>

  <h2>Créer un nouveau casting</h2>
  <form method="post" action="">
    <input type="hidden" name="action" value="create" />
    <label>Titre:</label><br/>
    <input type="text" name="titre" required/><br/>

    <label>Description:</label><br/>
    <textarea name="description" required></textarea><br/>

    <label>Date début:</label><br/>
    <input type="date" name="date_debut" required/><br/>

    <label>Date fin:</label><br/>
    <input type="date" name="date_fin" required/><br/>

    <label>Projet:</label><br/>
    <select name="projet_id" required>
      <option value="">-- Choisir un projet --</option>
      <?php foreach ($projets as $projet){
          echo '<option value="'.$projet['id'].'">'.htmlspecialchars($projet['title']).'</option>';
      } ?>
    </select><br/><br/>

    <button type="submit">Créer</button>
  </form>

  <h2>Mes castings</h2>
  <?php if (count($castings) === 0){
      echo '<p>Aucun casting trouvé.</p>';
  } else {
      echo '<table><thead><tr><th>Titre</th><th>Projet</th><th>Date début</th><th>Date fin</th></tr></thead><tbody>';
      foreach ($castings as $casting) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($casting['titre']) . '</td>';
          echo '<td>' . htmlspecialchars($casting['projet_titre']) . '</td>';
          echo '<td>' . htmlspecialchars($casting['date_debut']) . '</td>';
          echo '<td>' . htmlspecialchars($casting['date_fin']) . '</td>';
          echo '</tr>';
      }
      echo '</tbody></table>';
  }
?>
</div>
</body>
</html>
