<?php
session_start();

require 'require.php'; // Connexion BDD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['first-name'];
    $nom = $_POST['last-name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (prenom, nom, age, email, mdp) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$prenom, $nom, $age, $email, $mdp]);

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscrivez-vous</title>
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
  <h2>Inscription</h2>

  <form action="" method="POST">
    <input type="text" name="first-name" placeholder="Prénom" required>
    <input type="text" name="last-name" placeholder="Nom">
    <input type="number" name="age" placeholder="Âge" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">S'inscrire</button>
  </form>

  <p>Déjà un compte ? <a href="login.php">Connectez-vous !</a></p>
</div>

</body>
</html>
