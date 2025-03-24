<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artic - Accueil</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <script defer src="script.js"></script>
</head>
<body>
  <canvas id="background-canvas"></canvas>
  <?php include 'header.php'; ?>

  <section class="hero">
    <h2 id="animated-title">Plongez dans l’univers d’Artic</h2>
    <p>Une expérience visuelle entre l’abstrait et l’émotion, dans une atmosphère sombre et vibrante.</p>
    <a href="galerie.php" class="btn">Voir la Galerie</a>
  </section>

  <section class="gallery">
    <img src="image1.png" alt="Portrait Abstrait 1">
    <img src="image2.png" alt="Abstrait 2">
    <img src="image3.png" alt="Portrait Abstrait 3">
  </section>

  <footer>
    &copy; 2025 Artic. Tous droits réservés.
  </footer>
</body>
</html>
