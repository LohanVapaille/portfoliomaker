<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


require 'require.php'; // Fichier avec ta connexion PDO
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM infos_principales WHERE id_user = ?");
$stmt->execute([$user_id]);
$infos_princiaples = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM infos_principales WHERE id_user = ?");
$stmt->execute([$user_id]);
$infos_princiaples = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM section_about WHERE id_user = ?");
$stmt->execute([$user_id]);
$section_about = $stmt->fetch(PDO::FETCH_ASSOC);




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

// === INFOS PRINCIPALES ===
if (isset($_POST['localisation']) || isset($_POST['tel']) || isset($_POST['metier']) || isset($_POST['cv']) || isset($_POST['imagepp'])) {
    // Vérifier si une ligne existe déjà pour cet utilisateur
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM infos_principales WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $exists = $stmt->fetchColumn();

    // On récupère les valeurs soumises en POST (ou NULL si non envoyée)
    $localisation = $_POST['localisation'] ?? null;
    $tel = $_POST['tel'] ?? null;
    $metier = $_POST['metier'] ?? null;
    $cv = $_POST['cv'] ?? null;
    $imagepp = $_POST['imagepp'] ?? null;
    $css = null;

    if ($exists) {
        // Si l'utilisateur a déjà une ligne, on met à jour ce qui a été rempli
        if ($localisation) {
            $stmt = $pdo->prepare("UPDATE infos_principales SET localisation = ? WHERE id_user = ?");
            $stmt->execute([$localisation, $user_id]);
        }
        if ($tel) {
            $stmt = $pdo->prepare("UPDATE infos_principales SET telephone = ? WHERE id_user = ?");
            $stmt->execute([$tel, $user_id]);
        }
        if ($metier) {
            $stmt = $pdo->prepare("UPDATE infos_principales SET metier = ? WHERE id_user = ?");
            $stmt->execute([$metier, $user_id]);
        }
        if ($cv) {
            $stmt = $pdo->prepare("UPDATE infos_principales SET lien_cv = ? WHERE id_user = ?");
            $stmt->execute([$cv, $user_id]);
        }

        if ($imagepp) {
            $stmt = $pdo->prepare("UPDATE infos_principales SET imagepp = ? WHERE id_user = ?");
            $stmt->execute([$imagepp, $user_id]);
        }

        if ($css) {
            $stmt = $pdo->prepare("UPDATE infos_principales SET id_css = ? WHERE id_user = ?");
            $stmt->execute([$css, $user_id]);
        }
    } else {
        // Sinon on insère une nouvelle ligne
        $stmt = $pdo->prepare("INSERT INTO infos_principales (id_user, localisation, telephone, metier, lien_cv, imagepp, id_css ) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $localisation,
            $tel,
            $metier,
            $cv,
            $imagepp,
            $css
        ]);
    }
}

    // === SECTION ACCUEIL ===
if (isset($_POST['titre_portfolio']) || isset($_POST['phraseaccroche']) || isset($_POST['presentation'])) {
    // Vérifier si une ligne existe déjà pour cet utilisateur
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM section_about WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $exists = $stmt->fetchColumn();

    // Récupération des données du formulaire
    $titre_portfolio = $_POST['titre_portfolio'] ?? null;
    $phraseaccroche = $_POST['phraseaccroche'] ?? null;
    $presentation = $_POST['presentation'] ?? null;

    if ($exists) {
        // Mise à jour des champs remplis
        if ($titre_portfolio) {
            $stmt = $pdo->prepare("UPDATE section_about SET titre_accueil = ? WHERE id_user = ?");
            $stmt->execute([$titre_portfolio, $user_id]);
        }
        if ($phraseaccroche) {
            $stmt = $pdo->prepare("UPDATE section_about SET phrase_accroche = ? WHERE id_user = ?");
            $stmt->execute([$phraseaccroche, $user_id]);
        }
        if ($presentation) {
            $stmt = $pdo->prepare("UPDATE section_about SET apropos = ? WHERE id_user = ?");
            $stmt->execute([$presentation, $user_id]);
        }
    } else {
        // Insertion d'une nouvelle ligne
        $stmt = $pdo->prepare("INSERT INTO section_about (id_user, titre_accueil, phrase_accroche, apropos) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $titre_portfolio,
            $phraseaccroche,
            $presentation
        ]);
    }
}

    

    // === AJOUT CATEGORIE DE COMPETENCE ===
elseif (isset($_POST['categoriecreate']) && !empty($_POST['categoriecreate'])) {
    $stmt = $pdo->prepare("INSERT INTO section_competences_categorie (id_user, nom) VALUES (?, ?)");
    $stmt->execute([
        $user_id,
        $_POST['categoriecreate']
    ]);
}

// === AJOUT COMPETENCE ===
elseif (isset($_POST['competence'], $_POST['categorie']) && !empty($_POST['competence']) && !empty($_POST['categorie'])) {
    $stmt = $pdo->prepare("INSERT INTO section_competences (id_user, id_categorie, nom_competence,pourcent_competence) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $user_id,
        $_POST['categorie'],
        $_POST['competence'],
        $_POST['pourcent_competence']
    ]);
}


    // === PROJET ===
    elseif (isset($_POST['titre_projet'], $_POST['description_projet'], $_POST['lien'], $_POST['image'])) {
        $stmt = $pdo->prepare("INSERT INTO section_projets (id_user, titre_projet, description, lien, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $_POST['titre_projet'],
            $_POST['description_projet'],
            $_POST['lien'],
            $_POST['image']
        ]);
    }

    // === EXPÉRIENCE ===
    elseif (isset($_POST['titre_exp'], $_POST['lieu'], $_POST['debut'], $_POST['fin'], $_POST['description_exp'])) {
        $stmt = $pdo->prepare("INSERT INTO section_experiences (id_user, titre_experience, lieu, annee_debut, annee_fin, description_exp) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $_POST['titre_exp'],
            $_POST['lieu'],
            $_POST['debut'],
            $_POST['fin'],
            $_POST['description_exp']
        ]);
    }

    // === CONTACT ===

        // === SECTION Contact2 ===
if (isset($_POST['email']) || isset($_POST['message_contact']) || isset($_POST['titre_contact'])) {
    // Vérifier si une ligne existe déjà pour cet utilisateur
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM section_contact WHERE id_user = ?");
    $stmt->execute([$user_id]);
    $exists = $stmt->fetchColumn();

    // Récupération des données du formulaire
    $email = $_POST['email'] ?? null;
    $message = $_POST['message_contact'] ?? null;
    $titrecontact = $_POST['titre_contact'] ?? null;

    if ($exists) {
        // Mise à jour des champs remplis
        if ($email) {
            $stmt = $pdo->prepare("UPDATE section_contact SET mail_contact = ? WHERE id_user = ?");
            $stmt->execute([$email, $user_id]);
        }
        if ($message) {
            $stmt = $pdo->prepare("UPDATE section_contact SET description_contact = ? WHERE id_user = ?");
            $stmt->execute([$message, $user_id]);
        }
        if ($titrecontact) {
            $stmt = $pdo->prepare("UPDATE section_contact SET titre_contact = ? WHERE id_user = ?");
            $stmt->execute([$titrecontact, $user_id]);
        }
    } else {
        // Insertion d'une nouvelle ligne
        $stmt = $pdo->prepare("INSERT INTO section_contact (id_user, mail_contact, description_contact, titre_contact) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $email,
            $message,
            $titrecontact
        ]);
    }
}

    elseif (isset($_POST['email'], $_POST['message_contact'], $_POST['titre_contact'])) {
        $stmt = $pdo->prepare("INSERT INTO section_contact (id_user, mail_contact, description_contact, titre_contact) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $_POST['email'],
            $_POST['message_contact'],
            $_POST['titre_contact']

        ]);
    }
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .template-card {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 1rem;
        }
        .form-section {
            transition: all 0.3s ease;
        }
        .form-section:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .preview-card {
            border-left: 4px solid #a777e3;
            transition: all 0.3s ease;
        }
        .preview-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .skill-item{

            display: flex;
            padding: 10px;
            background-color: #f8f9fa;
            margin-bottom: 5px;
        }
        .skill-name{
            flex: 1;
            font-weight: bold;
            margin-right: 10px;
        }
        .titleandbutton{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }
        .project-image{
            width: 200px;
            
            object-fit: cover;
            border-radius: 8px;
        }

        .bx{

            font-size: 2rem;
            color:rgb(255, 0, 0);
        }
        .voir:hover{
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .retouraccueil{
            cursor: pointer;
        }

    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Sidebar Navigation -->
        <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg hidden md:block">
            <div class="p-6 gradient-bg text-white">
                <h1 class="retouraccueil text-2xl font-bold">Portfolio Manager</h1>
                <p class="text-sm opacity-80">Gérez votre portfolio</p>
            </div>
            <nav class="mt-6">
                <div class="px-6 py-3 font-medium text-gray-700 border-l-4 border-purple-500 bg-purple-50">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Tableau de bord
                </div>
                <a href="#personal-info" class="tab-link flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-3"></i>
                    Infos Personnelles
                </a>
                <a href="#home-section" class="tab-link flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-home mr-3"></i>
                    Section Accueil
                </a>
                <a href="#skills-section" class="tab-link flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-code mr-3"></i>
                    Compétences
                </a>
                <a href="#projects-section" class="tab-link flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-project-diagram mr-3"></i>
                    Projets
                </a>
                <a href="#experience-section" class="tab-link flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-briefcase mr-3"></i>
                    Expériences
                </a>
                <a href="#contact-section" class="tab-link flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-envelope mr-3"></i>
                    Contact
                </a>
                <a href="#style-section" class="tab-link flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-palette mr-3"></i>
                    Styles & Design
                </a>
            </nav>
        </div>

        <!-- Mobile Header -->
        <div class="md:hidden gradient-bg text-white p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Portfolio Manager</h1>
            <button id="mobile-menu-button" class="text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden bg-white shadow-lg md:hidden">
            <div class="flex flex-col">
                <a href="#personal-info" class="tab-link px-4 py-3 text-gray-700 border-b border-gray-200">
                    <i class="fas fa-user-circle mr-3"></i> Infos Personnelles
                </a>
                <a href="#home-section" class="tab-link px-4 py-3 text-gray-700 border-b border-gray-200">
                    <i class="fas fa-home mr-3"></i> Section Accueil
                </a>
                <a href="#skills-section" class="tab-link px-4 py-3 text-gray-700 border-b border-gray-200">
                    <i class="fas fa-code mr-3"></i> Compétences
                </a>
                <a href="#projects-section" class="tab-link px-4 py-3 text-gray-700 border-b border-gray-200">
                    <i class="fas fa-project-diagram mr-3"></i> Projets
                </a>
                <a href="#experience-section" class="tab-link px-4 py-3 text-gray-700 border-b border-gray-200">
                    <i class="fas fa-briefcase mr-3"></i> Expériences
                </a>
                <a href="#contact-section" class="tab-link px-4 py-3 text-gray-700 border-b border-gray-200">
                    <i class="fas fa-envelope mr-3"></i> Contact
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="md:ml-64 p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Back Office Portfolio</h1>
                    <p class="text-gray-600">Gérez votre portfolio professionnel</p>
                </div>

                <!-- Dashboard Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow-md p-6 hover-scale">
                        <div class="flex items-center">
                            <div class="feature-icon gradient-bg text-white">
                                <i class="fas fa-user text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-700">Infos Personnelles</h3>
                                <p class="text-sm text-gray-500">Vous êtes connecté(e) en tant que <?php 
                                echo $user['prenom']. " " . $user['nom']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="voir bg-white rounded-lg shadow-md p-6 transform transition-transform duration-300 hover:scale-105">
    <div class="flex items-center">
        <div class="feature-icon gradient-bg text-white">
            <i class="fas fa-project-diagram text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-700">Voir votre portfolio</h3>
                                <p class="text-sm text-gray-500">Accéder à votre portfolio</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6 hover-scale">
                        <div class="flex items-center">
                            <div class="feature-icon gradient-bg text-white">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-700">Statistiques</h3>
                                <p class="text-sm text-gray-500">Visualisez vos performances (à venir)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Sections -->
                <div id="personal-info" class="tab-content active">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden form-section mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-user-circle mr-2"></i> Infos Personnelles
                            </h2>
                        </div>
                        <div class="p-6">
                            <form action="" method="POST" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="localisation" class="block text-sm font-medium text-gray-700 mb-1">Localisation</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                                            </div>
                                            <input placeholder="<?php 
                                if(!empty( $infos_princiaples["localisation"])){echo $infos_princiaples["localisation"];} 
                                else{echo 'Où habitez vous ?';}?>" type="text" id="localisation" name="localisation" class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="tel" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-phone text-gray-400"></i>
                                            </div>
                                            <input placeholder="<?php 
                                if(!empty( $infos_princiaples["telephone"])){echo $infos_princiaples["telephone"];} 
                                else{echo 'Votre numéro de téléphone';}?>" type="text" id="tel" name="tel" class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="metier" class="block text-sm font-medium text-gray-700 mb-1">Métier/Activité</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-briefcase text-gray-400"></i>
                                            </div>
                                            <input type="text" placeholder="<?php 
                                if(!empty( $infos_princiaples['metier'])){echo $infos_princiaples['metier'];} 
                                else{echo 'Quelle est votre activité ?';}?>"id="metier" name="metier" class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="cv" class="block text-sm font-medium text-gray-700 mb-1">Lien CV (PDF)</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-file-pdf text-gray-400"></i>
                                            </div>
                                            <input type="text" id="cv" name="cv" class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150" placeholder="<?php 
                                if(!empty( $infos_princiaples["lien_cv"])){echo $infos_princiaples["lien_cv"];} 
                                else{echo 'Charger votre CV';}?>">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="imagepp" class="block text-sm font-medium text-gray-700 mb-1">Photo de Profil</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                                            </div>
                                            <input placeholder="<?php 
                                if(!empty( $infos_princiaples["imagepp"])){echo $infos_princiaples["imagepp"];} 
                                else{echo 'Ajouter une photot de profil';}?>" type="text" id="imagepp" name="imagepp" class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                    </div>
                                </div>
                                                                
                                <div class="pt-4">
                                    <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <i class="fas fa-save mr-2"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Personal Info Preview -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-eye mr-2"></i> Aperçu des Infos Personnelles
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="preview-card bg-gray-50 p-4 rounded-md">
                                    <div class="flex items-center mb-4">
                                        <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center">
                                            <i class="fas fa-user-circle text-3xl text-purple-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="font-semibold text-gray-800"><?php echo $user['prenom']. " " . $user['nom']; ?></h3>
                                            <p class="text-sm text-gray-500" id="preview-metier"><?php 
                                if(!empty( $infos_princiaples['metier'])){echo $infos_princiaples['metier'];} 
                                else{echo 'Quelle est votre activité ?';}?></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-purple-500 mr-2"></i>
                                            <span class="text-gray-700" id="preview-localisation"><?php 
                                if(!empty( $infos_princiaples["localisation"])){echo $infos_princiaples["localisation"];} 
                                else{echo 'Où habitez vous ?';}?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-purple-500 mr-2"></i>
                                            <span class="text-gray-700" id="preview-tel"><?php 
                                if(!empty( $infos_princiaples["telephone"])){echo $infos_princiaples["telephone"];} 
                                else{echo 'Votre numéro de téléphone';}?></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-purple-500 mr-2"></i>
                                            <span class="text-gray-700"><?php echo $user['email']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-card bg-gray-50 p-4 rounded-md">
                                    <h3 class="font-semibold text-gray-800 mb-3">CV & Profil</h3>
                                    <div class="flex items-center mb-3">
                                        <i class="fas fa-file-pdf text-purple-500 mr-2"></i>
                                        <a href="#" class="text-blue-600 hover:underline" id="preview-cv">Télécharger mon CV</a>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-user-circle text-purple-500 mr-2"></i>
                                        <span class="text-gray-700" id="preview-imagepp">Photo de profil</span>
                                        <img src="<?php 
                                if(!empty( $infos_princiaples["imagepp"])){echo $infos_princiaples["imagepp"];} 
                                else{echo 'https://img.freepik.com/vecteurs-premium/illustration-vectorielle-plate-echelle-gris-avatar-profil-utilisateur-icone-personne-image-profil-silhouette-neutre-genre-convient-pour-profils-medias-sociaux-icones-economiseurs-ecran-comme-modelex9xa_719432-2210.jpg';}?>" alt="apercu de votre photo de profil" class="w-20 h-auto rounded-full ml-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="home-section" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden form-section mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-home mr-2"></i> Section Accueil
                            </h2>
                        </div>
                        <div class="p-6">
                            <form action="" method="POST" class="space-y-4">
                                <div>
                                    <label for="titre_portfolio" class="block text-sm font-medium text-gray-700 mb-1">Titre du Portfolio</label>
                                    <input type="text" id="titre_portfolio" name="titre_portfolio" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                </div>
                                <div>
                                    <label for="phraseaccroche" class="block text-sm font-medium text-gray-700 mb-1">Phrase d'accroche</label>
                                    <input type="text" id="phraseaccroche" name="phraseaccroche" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                </div>
                                <div>
                                    <label for="presentation" class="block text-sm font-medium text-gray-700 mb-1">Présentation</label>
                                    <textarea id="presentation" name="presentation" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150"></textarea>
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <i class="fas fa-save mr-2"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Home Section Preview -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-eye mr-2"></i> Aperçu de la Section Accueil
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="preview-card bg-gray-50 p-6 rounded-md">
                                <h1 class="text-3xl font-bold text-gray-800 mb-2" id="preview-titre-portfolio"><?php
                                if (!empty($section_about['titre_accueil'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_about['titre_accueil']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Bienvenue sur mon portfolio !';
                                }
                              ?></h1>
                                <p class="text-xl text-purple-600 mb-4" id="preview-phraseaccroche"><?php
                                if (!empty($section_about['phrase_accroche'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_about['phrase_accroche']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Découvrez mon travail et mes compétences';
                                }
                              ?></p><br>
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">A propos de moi</h2>
                                <p class="text-gray-700" id="preview-presentation"><?php
                                if (!empty($section_about['apropos'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_about['apropos']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.';
                                }
                              ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="skills-section" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden form-section mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-code mr-2"></i> Compétences
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <form action="" method="POST" class="bg-gray-50 p-4 rounded-md">
                                    <h3 class="font-medium text-gray-700 mb-3">
                                        <i class="fas fa-plus-circle mr-2 text-purple-500"></i> Ajouter une catégorie
                                    </h3>
                                    <div class="flex items-end space-x-4">
                                        <div class="flex-1">
                                            <label for="categoriecreate" class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie</label>
                                            <input type="text" id="categoriecreate" name="categoriecreate" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                        <div>
                                            <button type="submit" class="gradient-bg text-white px-4 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                <i class="fas fa-plus mr-1"></i> Ajouter
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <form action="" method="POST" class="bg-gray-50 p-4 rounded-md">
                                    <h3 class="font-medium text-gray-700 mb-3">
                                        <i class="fas fa-code mr-2 text-purple-500"></i> Ajouter une compétence
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label for="categorie" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                                            <select id="categorie" name="categorie" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                            <?php 
                                                $stmt = $pdo->prepare(
                                                    "SELECT *
                                                    FROM section_competences_categorie
                                                    WHERE id_user = ?"
                                                );
                                                $stmt->execute([$user_id]);
                                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                if (empty($categories)) {
                                                    echo '<option disabled selected>Aucune catégorie trouvée</option>';
                                                } else {
                                                    foreach ($categories as $cat) {
                                                        echo '<option value="'.htmlspecialchars($cat['id_categorie']).'">'
                                                            .htmlspecialchars($cat['nom'])
                                                            .'</option>';
                                                    }
                                                }
                                                                                                
                                            ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="competence" class="block text-sm font-medium text-gray-700 mb-1">Compétence</label>
                                            <input type="text" id="competence" name="competence" placeholder="Ex: HTML, CSS, PHP..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                        <div>
                                            <label for="pourcent_competence" class="block text-sm font-medium text-gray-700 mb-1">Niveau (%)</label>
                                            <input type="number" id="pourcent_competence" name="pourcent_competence" min="0" max="100" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <button type="submit" class="gradient-bg text-white px-4 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            <i class="fas fa-plus mr-1"></i> Ajouter
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Preview -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-eye mr-2"></i> Aperçu des Compétences
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php 
$stmt = $pdo->prepare("SELECT * FROM section_competences_categorie WHERE id_user = ?");
$stmt->execute([$user_id]);
$section_competences_categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
foreach ($section_competences_categorie as $categorie) {
    echo '<div class="skill-category">';
    echo '<div class="titleandbutton">';
    echo '<h3 class="skill-category-title">' . htmlspecialchars($categorie['nom']) . '</h3>';

    // Bouton suppression catégorie
    echo '<form method="POST" action="delete.php" style="display:inline;margin-left:10px;" onsubmit="return confirm(\'Supprimer cette catégorie ?\');">';
    echo '<input type="hidden" name="id_categorie" value="' . $categorie['id_categorie'] . '">';
    echo '<button type="submit" name="delete_categorie">🗑</button>';
    echo '</form>';
    echo '</div>';
    echo '<ul class="skills-list">';

    // Récupérer les compétences de cette catégorie
    $stmt = $pdo->prepare("SELECT * FROM section_competences WHERE id_categorie = ? AND id_user = ?");
    $stmt->execute([$categorie['id_categorie'], $user_id]);
    $competences = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($competences as $competence) {
        echo '<li class="skill-item">';
        echo '<span class="skill-name">' . htmlspecialchars($competence['nom_competence']) . '</span>';
        echo '<p>' . htmlspecialchars($competence['pourcent_competence']) . '%</p>';

        // Bouton suppression compétence
        echo '<form method="POST" action="delete.php" style="margin-left:10px;" onsubmit="return confirm(\'Supprimer cette compétence ?\');">';
        echo '<input type="hidden" name="id_competence" value="' . $competence['id_section_competences'] . '">';
        echo '<button type="submit" name="delete_competence">❌</button>';
        echo '</form>';

        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
}
?>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="projects-section" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden form-section mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-project-diagram mr-2"></i> Projets
                            </h2>
                        </div>
                        <div class="p-6">
                            <form action="" method="POST" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="titre_projet" class="block text-sm font-medium text-gray-700 mb-1">Titre du projet</label>
                                        <input type="text" id="titre_projet" name="titre_projet" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                    </div>
                                    <div>
                                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image (URL)</label>
                                        <input type="url" id="image" name="image" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                    </div>
                                </div>
                                <div>
                                    <label for="description_projet" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="description_projet" name="description_projet" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150"></textarea>
                                </div>
                                <div>
                                    <label for="lien" class="block text-sm font-medium text-gray-700 mb-1">Lien du projet</label>
                                    <input type="url" id="lien" name="lien" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <i class="fas fa-plus mr-2"></i> Ajouter le projet
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Projects Preview -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-eye mr-2"></i> Aperçu des Projets
                            </h2>
                        </div>
                        
                        <?php 
$stmt = $pdo->prepare("SELECT * FROM section_projets WHERE id_user = ?");
$stmt->execute([$user_id]);
$section_projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <?php foreach ($section_projets as $projet): ?>
            
            <div class="preview-card bg-gray-50 rounded-md overflow-hidden">
            <form method="POST" action="delete.php" style="margin-right:10px; margin-top:10px; float:right;"  onsubmit="return confirm('Supprimer ce projet ?');">
            <input type="hidden" name="id_projet" value=" <?php echo $projet['id_projet'];?> ">
            <button type="submit" name="delete_projet">❌</button></form>
                <?php if (!empty($projet['image'])): ?>
                    <img src="<?php echo htmlspecialchars($projet['image']) ?>" alt="Projet" class="project-image">
                <?php endif; ?>

                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2"><?= htmlspecialchars($projet['titre_projet']) ?></h3>
                    <p class="text-gray-600 text-sm mb-3"><?= htmlspecialchars($projet['description']) ?></p>
                    <a href="<?= htmlspecialchars($projet['lien']) ?>" class="text-purple-600 hover:underline text-sm font-medium" target='_blank'>Voir le projet →</a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
                    </div>
                </div>

                <div id="experience-section" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden form-section mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-briefcase mr-2"></i> Expériences Professionnelles
                            </h2>
                        </div>
                        <div class="p-6">
                            <form action="" method="POST" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="titre_exp" class="block text-sm font-medium text-gray-700 mb-1">Titre du poste</label>
                                        <input type="text" id="titre_exp" name="titre_exp" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                    </div>
                                    <div>
                                        <label for="lieu" class="block text-sm font-medium text-gray-700 mb-1">Lieu/Entreprise</label>
                                        <input type="text" id="lieu" name="lieu" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                    </div>
                                    <div>
                                        <label for="debut" class="block text-sm font-medium text-gray-700 mb-1">Année de début</label>
                                        <input type="number" id="debut" name="debut" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                    </div>
                                    <div>
                                        <label for="fin" class="block text-sm font-medium text-gray-700 mb-1">Année de fin</label>
                                        <input type="text" id="fin" name="fin" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                    </div>
                                </div>
                                <div>
                                    <label for="description_exp" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="description_exp" name="description_exp" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150"></textarea>
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <i class="fas fa-plus mr-2"></i> Ajouter l'expérience
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Experience Preview -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-eye mr-2"></i> Aperçu des Expériences
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                            <?php 
                $stmt = $pdo->prepare("SELECT * FROM section_experiences WHERE id_user = ? ORDER BY annee_debut DESC");
                $stmt->execute([$user_id]);
                $section_experiences = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($section_experiences as $experience) { ?>
                <div class="preview-card bg-gray-50 p-6 rounded-md" style="position:relative;">
                <form method="POST" action="delete.php" style=" position:absolute;bottom:10px; right:10px; float:right;"  onsubmit="return confirm('Supprimer cette experience ?');">
            <input type="hidden" name="id_experience" value=" <?php echo $experience['id_experience'];?> ">
            <button type="submit" name="delete_projet"><i class='bx bx-message-alt-x ' ></i></button></form>
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-semibold text-gray-800"><?php echo $experience['titre_experience'];?></h3>
                                            <p class="text-gray-600"><?php echo $experience['lieu'];?></p>
                                        </div>
                                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded"><?php echo $experience['annee_debut'];?> - <?php echo $experience['annee_fin'];?></span>
                                    </div>
                                    <div class="mt-4">
                                        <p class="text-gray-700"><?php echo $experience['description_exp'];?></p>
                                    </div>
                                </div>
                <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div id="contact-section" class="tab-content">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden form-section mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-envelope mr-2"></i> Section Contact
                            </h2>
                        </div>
                        <div class="p-6">
                            <form action="" method="POST" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email de contact</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-envelope text-gray-400"></i>
                                            </div>
                                            <input type="email" id="email" name="email" class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="titre_contact" class="block text-sm font-medium text-gray-700 mb-1">Titre de contact</label>
                                        <input type="text" id="titre_contact" name="titre_contact" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                                    </div>
                                </div>
                                <div>
                                    <label for="message_contact" class="block text-sm font-medium text-gray-700 mb-1">Message de contact</label>
                                    <textarea id="message_contact" name="message_contact" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150"></textarea>
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <i class="fas fa-save mr-2"></i> Enregistrer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Preview -->

                    <?php
                        $stmt = $pdo->prepare("SELECT * FROM section_contact WHERE id_user = ?");   
                        $stmt->execute([$user_id]);
                        $section_contact = $stmt->fetch(PDO::FETCH_ASSOC);?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-eye mr-2"></i> Aperçu de la Section Contact
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="preview-card bg-gray-50 p-6 rounded-md">
                                
                                <h2 class="text-2xl font-bold text-gray-800 mb-4" id="preview-titre-contact"><?php
if (!empty($section_contact['titre_contact'])) {
    echo $section_contact['titre_contact'];
} else {
    // Valeur par défaut si rien n'est renseigné
    echo 'Contactez moi !';
}
?></h2>
                                <p class="text-gray-700 mb-6" id="preview-message-contact"><?php
if (!empty($section_contact['description_contact'])) {
    echo $section_contact['description_contact'];
} else {
    // Valeur par défaut si rien n'est renseigné
    echo 'Contactez-moi en remplissant le formulaire ci-dessous!';
}
?></p>
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-envelope text-purple-500 mr-3 text-xl"></i>
                                    <span class="text-gray-700" id="preview-email"><?php
if (!empty($section_contact['mail_contact'])) {
    echo $section_contact['mail_contact'];
} else {
    // Valeur par défaut si rien n'est renseigné
    echo $user['email'];
}
?></span>
                                </div>
                                <form class="mt-6 space-y-4">
                                    <div>
                                        <input type="text" placeholder="Votre nom" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150 p-2">
                                    </div>
                                    <div>
                                        <input type="email" placeholder="Votre email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150 p-2">
                                    </div>
                                    <div>
                                        <textarea rows="4" placeholder="Votre message" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150 p-2"></textarea>
                                    </div>
                                    <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        Envoyer le message
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Style CSS Selection -->

               <?php


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_css'], $_POST['user_id'])) {
    $id_css = intval($_POST['id_css']);
    $user_id = intval($_POST['user_id']);

    $stmt = $pdo->prepare("UPDATE infos_principales SET id_css = ? WHERE id_user = ?");
    $stmt->execute([$id_css, $user_id]);

}
?>

<div id="style-section" class="tab-content">
    <div class="bg-white rounded-lg shadow-md overflow-hidden form-section mb-8">
        <div class="gradient-bg px-6 py-4">
            <h2 class="text-xl font-semibold text-white">
                <i class="fas fa-paint-brush mr-2"></i> Choix du style CSS
            </h2>
        </div>
        <div class="p-6">
            <form action="" method="POST" class="space-y-4">
                <div>
                    <label for="id_css" class="block text-sm font-medium text-gray-700 mb-1">Sélectionnez un style</label>
                    <select id="id_css" name="id_css" class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 transition duration-150">
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM styles_css");
                        $stmt->execute();
                        $styles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Récupération du style actuel de l'utilisateur (si déjà enregistré)
                        $stmt2 = $pdo->prepare("SELECT id_css FROM infos_principales WHERE id_user = ?");
                        $stmt2->execute([$user_id]);
                        $current_style = $stmt2->fetchColumn();
                        var_dump($current_style);
                        

                        foreach ($styles as $style) {
                            $selected = ($style['id_css'] == $current_style) ? 'selected' : '';
                            echo "<option value=\"{$style['id_css']}\" $selected>" . htmlspecialchars($style['nomaffiche']) . "</option>";
                        }


                        
                        ?>
                    </select>
                </div>

                <div class="pt-4">
                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                    <button type="submit" class="gradient-bg text-white px-6 py-2 rounded-md hover:opacity-90 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-save mr-2"></i> Enregistrer le style
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                        <div class="gradient-bg px-6 py-4">
                            <h2 class="text-xl font-semibold text-white">
                                <i class="fas fa-eye mr-2"></i> Aperçu du style appliqué
                            </h2>
                        </div>

                        <?php
// Trouver l'aperçu correspondant au style actuellement sélectionné
$apercu_actuel = null;
foreach ($styles as $style) {
    if ($style['id_css'] == $current_style) {
        $apercu_actuel = $style['apercu'];
        break;
    }
}
?>

                        <div class="p-6">
                            <?php if ($apercu_actuel): ?>
    <img src="<?= $apercu_actuel; ?>" alt="Aperçu du style sélectionné" class="rounded shadow-md">
<?php else: ?>
    <p class="text-gray-500">Aucun aperçu disponible pour ce style.</p>
<?php endif; ?>

                            </div>
                        </div>
                    </div>
</div>

            </div>
        </div>
    </div>

    <script>

const voir = document.querySelector('.voir');
    voir.addEventListener('click', function() {
        // Assure-toi que la variable PHP $user_id est correctement insérée dans le script
        window.location.href = 'portfolio.php' + '<?php echo "?id=" . $user_id; ?>';
    });

    const retour = document.querySelector('.retouraccueil');
    retour.addEventListener('click', function() {
        // Assure-toi que la variable PHP $user_id est correctement insérée dans le script
        window.location.href = 'index.php';
    });
// Mobile menu toggle
document.getElementById('mobile-menu-button').addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});

// Tab navigation
document.querySelectorAll('.tab-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();

        // 🔥 Save active tab TARGET ID in localStorage (href)
        const targetId = this.getAttribute('href').substring(1);
        localStorage.setItem('activeTabTarget', targetId);

        // Hide mobile menu if open
        document.getElementById('mobile-menu').classList.add('hidden');

        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        // Show target tab content
        document.getElementById(targetId).classList.add('active');

        // Update active tab indicator (for desktop sidebar)
        document.querySelectorAll('.tab-link').forEach(tab => {
            tab.parentElement.classList.remove('border-l-4', 'border-purple-500', 'bg-purple-50');
            tab.classList.remove('text-purple-600');
        });

        // Highlight current tab (if in desktop sidebar)
        if (this.parentElement.classList.contains('md:block')) {
            this.parentElement.classList.add('border-l-4', 'border-purple-500', 'bg-purple-50');
            this.classList.add('text-purple-600');
        }

        // Scroll to section
        document.getElementById(targetId).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Restore active tab after reload
window.addEventListener('load', function() {
    const activeTabTarget = localStorage.getItem('activeTabTarget');
    if (activeTabTarget) {
        const tabLink = document.querySelector(`.tab-link[href="#${activeTabTarget}"]`);
        if (tabLink) {
            tabLink.click();
        } else {
            document.querySelector('.tab-link').click(); // fallback
        }
    } else {
        document.querySelector('.tab-link').click(); // default first tab
    }
});

// Update previews when form inputs change
document.querySelectorAll('input, textarea, select').forEach(input => {
    input.addEventListener('input', function() {
        const previewId = 'preview-' + this.id.replace('_', '-');
        const previewElement = document.getElementById(previewId);
        if (previewElement) {
            previewElement.textContent = this.value;
        }
    });
});

</script>

</body>
</html>
