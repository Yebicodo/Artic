<?php
require_once 'config.php'; // Connexion centralisée

// Récupération des actualités
$sql = "SELECT * FROM actualites ORDER BY date_publication DESC";
$stmt = $pdo->query($sql);
$actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artic</title>
  <link rel="stylesheet" href="actualites.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <section class="actualites">
    <!-- <h2>Les dernieres nouvelles</h2> -->

    <?php foreach ($actualites as $actu): ?>
      <article>
        <h3><?= htmlspecialchars($actu['titre']) ?></h3>
        <p class="date">
          Publié le <?= date("d/m/Y", strtotime($actu['date_publication'])) ?>
        </p>
        <?php if (!empty($actu['image_url'])): ?>
          <img src="<?= htmlspecialchars($actu['image_url']) ?>" alt="Illustration">
        <?php endif; ?>
        <p class="contenu"><?= nl2br(htmlspecialchars($actu['contenu'])) ?></p>

        <?php if (!empty($actu['pdf_url'])): ?>
          <a href="<?= htmlspecialchars($actu['pdf_url']) ?>" target="_blank" class="btn">"Découvrez maintenant."</a>
        <?php endif; ?>
      </article>
    <?php endforeach; ?>
  </section>

  <footer>
    &copy; 2025 Artic. Tous droits réservés.
  </footer>
</body>
</html>
