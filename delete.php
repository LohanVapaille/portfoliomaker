<?php
require 'require.php'; // Change si ton fichier de connexion a un autre nom

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['delete_competence'])) {
        $id = $_POST['id_competence'];
        $stmt = $pdo->prepare("DELETE FROM section_competences WHERE id_section_competences = ?");
        $stmt->execute([$id]);
    }

    if (isset($_POST['delete_categorie'])) {
        $id = $_POST['id_categorie'];

        // Supprimer d'abord les compétences de cette catégorie
        $stmt = $pdo->prepare("DELETE FROM section_competences WHERE id_categorie = ?");
        $stmt->execute([$id]);

        // Puis supprimer la catégorie
        $stmt = $pdo->prepare("DELETE FROM section_competences_categorie WHERE id_categorie = ?");
        $stmt->execute([$id]);
    }

    if (isset($_POST['delete_projet'])) {
        $id = $_POST['id_projet'];

        $stmt = $pdo->prepare("DELETE FROM section_projets WHERE id_projet = ?");
        $stmt->execute([$id]);



    }

    if (isset($_POST['delete_projet'])) {
        $id = $_POST['id_experience'];

        $stmt = $pdo->prepare("DELETE FROM section_experiences WHERE id_experience = ?");
        $stmt->execute([$id]);



    }

    // Redirection pour éviter les re-POST
    header("Location: backoffice.php");
    exit();
}
