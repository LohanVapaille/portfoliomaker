<?php
session_start();


require 'require.php'; // Ce fichier doit contenir la connexion à la BDD, ex : $pdo = new PDO(...);

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupération des données du formulaire
    $prenom = $_POST['first-name'];
    $nom = $_POST['last-name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT); // sécuriser le mot de passe

    // Insertion dans la BDD
    $stmt = $pdo->prepare("INSERT INTO users (prenom, nom, age, email, mdp) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$prenom, $nom, $age, $email, $mdp]);

    
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscriez-vous</title>
</head>
<body>

<form action="" method="POST">
  <input type="text" name="first-name" placeholder="Prénom" required>
  <input type="text" name="last-name" placeholder="Nom" required>
  <input type="number" name="age" placeholder="Age" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit">S'inscrire</button>
</form>

</body>
</html>