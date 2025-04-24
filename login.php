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
        // header('Location: profil.php');
        // exit;
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
  <style>
    body {
      font-family: Arial;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 80px;
    }
    form {
      display: flex;
      flex-direction: column;
      width: 300px;
    }
    input, button {
      margin-bottom: 10px;
      padding: 10px;
      font-size: 16px;
    }
    .message {
      margin-top: 20px;
      color: #333;
    }
  </style>
</head>
<body>

<h2>Connexion</h2>

<form method="POST" action="">
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit">Se connecter</button>
</form>



<?php if ($message): ?>
  <div class="message"><?= htmlspecialchars($message) ?></div>
  <a href="logout.php">Se déconnecter</a>
<?php endif; ?>




</body>
</html>
