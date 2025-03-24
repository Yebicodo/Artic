<?php
$pdo = new PDO("mysql:host=localhost;dbname=artic;charset=utf8", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titre = $_POST['titre'];
  $contenu = $_POST['contenu'];
  $date = date('Y-m-d');

  if ($_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['pdf']['name']);
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $filePath)) {
      $stmt = $pdo->prepare("INSERT INTO actualites (titre, contenu, date_publication, pdf_url) VALUES (?, ?, ?, ?)");
      $stmt->execute([$titre, $contenu, $date, $filePath]);
      echo "PDF et actualité enregistrés avec succès.";
    } else {
      echo "Erreur lors du déplacement du fichier.";
    }
  } else {
    echo "Erreur lors de l'envoi du fichier.";
  }
}
?>
