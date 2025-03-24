<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

require_once 'config.php'; // ➕ ajoute ligne AVANT d'utiliser SMTP_USER


$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $message = trim($_POST["message"]);

  // Validation
  if (empty($name)) $errors[] = "Le nom est requis.";
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalide.";
  if (empty($message)) $errors[] = "Le message est requis.";

  if (empty($errors)) {
    $mail = new PHPMailer(true);
    try {
      // Configuration SMTP
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    // Ton mot de passe d'application
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      // Destinataire
      $mail->setFrom($email, $name);
      $mail->addAddress('vivierayan@gmail.com');

      // Contenu
      $mail->isHTML(true);
      $mail->Subject = 'Nouveau message depuis le formulaire Artic';
      $mail->Body = "<b>Nom :</b> $name<br><b>Email :</b> $email<br><b>Message :</b><br>$message";

      $mail->send();
      $success = true;

      // Enregistrement dans la base de données
      require_once 'config.php';
      $stmt = $pdo->prepare("INSERT INTO messages (nom, email, message) VALUES (?, ?, ?)");
      $stmt->execute([$name, $email, $message]);
    } catch (Exception $e) {
      $errors[] = "Erreur d'envoi : " . $mail->ErrorInfo;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <link rel="stylesheet" href="contact.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <section class="contact">
    <h2>Contactez-nous</h2>

    <?php if ($success): ?>
      <p class="success">Votre message a été envoyé avec succès !</p>
    <?php elseif (!empty($errors)): ?>
      <ul class="errors">
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form method="post" action="contact.php">
      <label>Nom :</label>
      <input type="text" name="name" required>

      <label>Email :</label>
      <input type="email" name="email" required>

      <label>Message :</label>
      <textarea name="message" rows="5" required></textarea>

      <button type="submit">Envoyer</button>
    </form>
  </section>
</body>
</html>
