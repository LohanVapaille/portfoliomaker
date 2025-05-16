<?php 

require 'require.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];
    
} else {
    $id_user = null;
    
}

$stmt = $pdo->query("SELECT * FROM styles_css");
$styles = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio-Maker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .exemple:hover{
            opacity: 1.8;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-palette text-purple-600 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">Portfolio<span class="text-purple-600">Maker</span></span>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                    <a href="index.php" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">Retour à l'accueil</a>
                    
                    <a href="backoffice.php" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">Acceder au backoffice</a>
                    
                </div>
                <div class="flex items-center">

                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="logout.php" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">Se déconnecter</a>
    <a href="portfolio.php?id=<?php echo $id_user?>" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Mon portfolio</a>
<?php } else { ?>
    <a href="inscription.php" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">S'inscrire</a>
    <a href="login.php" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Se connecter</a>
<?php } ?>

                </div>
            </div>
        </div>
    </nav>
    
    <body>

        <div id="templates" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">Nos modèles</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Choisissez votre style
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Plus de 10 designs modernes et épurés à venir pour tous les profils et d'autres à venir.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        

<?php foreach ($styles as $style): ?>
  <div class="exemple group relative bg-white rounded-lg overflow-hidden shadow-md template-card hover-scale">
    <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
      <img src="<?php echo $style['apercu']; ?>" alt="aperçu" />
    </div>

    <!-- Overlay noir avec bouton -->
    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center">
      <a href="backoffice.php" class="opacity-0 group-hover:opacity-100 transition duration-300 bg-white text-black font-semibold px-4 py-2 rounded shadow">
        Choisir
      </a>
    </div>

    <div class="p-6">
      <h3 class="text-xl font-semibold text-gray-900"><?php echo $style['type']; ?></h3>
      <p class="mt-2 text-gray-600">
        <?php echo $style['description']; ?>
      </p>
      <div class="mt-4">
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
          <?php echo $style['etiquette1']; ?>
        </span>
        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
          <?php echo $style['etiquette2']; ?>
        </span>
      </div>
    </div>
  </div>
<?php endforeach; ?>
 
    
                

</body>