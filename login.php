<?php
session_start();
require 'require.php'; // Fichier de connexion PDO avec $pdo

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'email existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['mdp'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id_user'];
        $message = "Connexion réussie ! ID : " . $_SESSION['user_id'];

        // Redirection possible
        header('Location: index.php');
        exit;
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
    }
    .template-card {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 
                  0 4px 6px -2px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 320px;
      transition: transform 0.3s ease;
    }
    .template-card:hover {
      transform: scale(1.05);
    }
    form {
      display: flex;
      flex-direction: column;
      width: 100%;
    }
    input, button {
      margin-bottom: 10px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      background-color: #6e8efb;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #5a73d7;
    }
    .message {
      margin-top: 20px;
      color: #333;
      text-align: center;
    }
    a {
      color: #6e8efb;
      text-decoration: none;
      font-weight: bold;
    }
    a:hover {
      text-decoration: underline;
    }
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
  </style>
</head>
<body>

<div class="template-card">
  <h2>Connexion</h2>

  <form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
  </form>

  <p>Vous n'avez pas de compte ? <a href="inscription.php">Créez en un !</a></p>
  <p><a href="index.php">Accéder sans se connecter</a></p>

  <?php if ($message): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
    <a href="logout.php">Se déconnecter</a>
  <?php endif; ?>
</div>

</body>
</html>
