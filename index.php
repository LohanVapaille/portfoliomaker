<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio-Maker - Créez votre portfolio personnalisé</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <a href="#features" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">Fonctionnalités</a>
                    <a href="#templates" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">Modèles</a>
                    <a href="#how-it-works" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">Comment ça marche</a>
                    <a href="#contact" class="text-gray-500 hover:text-purple-600 px-3 py-2 text-sm font-medium">Contact</a>
                </div>
                <div class="flex items-center">
                    <a href="#download" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Télécharger
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="gradient-bg">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white">
                Créez votre portfolio <span class="block">en quelques minutes</span>
            </h1>
            <p class="mt-6 max-w-lg mx-auto text-xl text-purple-100">
                Portfolio-Maker vous offre des templates modernes et personnalisables pour mettre en valeur votre travail et vos compétences.
            </p>
            <div class="mt-10 flex justify-center space-x-4">
                <a href="#download" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-purple-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                    Télécharger maintenant
                </a>
                <a href="#templates" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-purple-600 bg-opacity-60 hover:bg-opacity-70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Voir les modèles
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">Fonctionnalités</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Pourquoi choisir Portfolio-Maker ?
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Des solutions simples pour une présentation professionnelle
                </p>
            </div>

            <div class="mt-20">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
                    <div class="text-center">
                        <div class="feature-icon bg-purple-100 text-purple-600 mx-auto">
                            <i class="fas fa-magic text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Personnalisation facile</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Modifiez les couleurs, polices et contenus en quelques clics sans aucune compétence technique.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="feature-icon bg-purple-100 text-purple-600 mx-auto">
                            <i class="fas fa-mobile-alt text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Responsive design</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Tous nos templates s'adaptent parfaitement à tous les écrans, du smartphone à l'ordinateur.
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="feature-icon bg-purple-100 text-purple-600 mx-auto">
                            <i class="fas fa-bolt text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Rapide à mettre en place</h3>
                        <p class="mt-2 text-base text-gray-500">
                            Téléchargez, personnalisez et déployez votre portfolio en moins d'une heure.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Templates Section -->
    <div id="templates" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">Nos modèles</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Choisissez votre style
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Des designs modernes et épurés pour tous les profils
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Template 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md template-card hover-scale">
                    <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                        <i class="fas fa-eye text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">Minimaliste</h3>
                        <p class="mt-2 text-gray-600">
                            Design épuré mettant en avant votre contenu sans distractions.
                        </p>
                        <div class="mt-4">
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#simple</span>
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#élégant</span>
                        </div>
                    </div>
                </div>

                <!-- Template 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md template-card hover-scale">
                    <div class="h-48 bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center">
                        <i class="fas fa-briefcase text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">Professionnel</h3>
                        <p class="mt-2 text-gray-600">
                            Structure idéale pour les freelances et professionnels expérimentés.
                        </p>
                        <div class="mt-4">
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#corporate</span>
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#pro</span>
                        </div>
                    </div>
                </div>

                <!-- Template 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md template-card hover-scale">
                    <div class="h-48 bg-gradient-to-r from-yellow-400 to-red-500 flex items-center justify-center">
                        <i class="fas fa-paint-brush text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900">Créatif</h3>
                        <p class="mt-2 text-gray-600">
                            Pour les artistes et designers qui veulent sortir du cadre.
                        </p>
                        <div class="mt-4">
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#artistique</span>
                            <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#unique</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#download" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Voir tous les modèles
                </a>
            </div>
        </div>
    </div>

    <!-- How it works -->
    <div id="how-it-works" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">Comment ça marche</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    En 3 étapes simples
                </p>
            </div>

            <div class="mt-16">
                <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                    <div class="relative pb-12">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <span class="text-xl font-bold">1</span>
                        </div>
                        <div class="relative ml-16">
                            <h3 class="text-lg font-medium text-gray-900">Téléchargez</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Choisissez votre template préféré et téléchargez le package complet.
                            </p>
                        </div>
                    </div>

                    <div class="relative pb-12">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <span class="text-xl font-bold">2</span>
                        </div>
                        <div class="relative ml-16">
                            <h3 class="text-lg font-medium text-gray-900">Personnalisez</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Modifiez le contenu, les couleurs et les images directement dans les fichiers fournis.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <span class="text-xl font-bold">3</span>
                        </div>
                        <div class="relative ml-16">
                            <h3 class="text-lg font-medium text-gray-900">Déployez</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Mettez en ligne votre portfolio sur votre hébergement préféré et partagez-le !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div id="download" class="gradient-bg">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Prêt à créer votre portfolio ?</span>
                <span class="block text-purple-200">Téléchargez votre template dès maintenant.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-purple-600 bg-white hover:bg-gray-50">
                        <i class="fas fa-download mr-2"></i> Télécharger
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 bg-opacity-60 hover:bg-opacity-70">
                        Voir la démo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="bg-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Des questions ?
                </h2>
                <p class="mt-4 text-lg leading-6 text-gray-500">
                    Contactez notre équipe pour plus d'informations
                </p>
            </div>
            <div class="mt-12">
                <div class="bg-gray-50 rounded-lg p-8 max-w-2xl mx-auto">
                    <form class="space-y-8">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" required class="py-3 px-4 block w-full shadow-sm focus:ring-purple-500 focus:border-purple-500 border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required class="py-3 px-4 block w-full shadow-sm focus:ring-purple-500 focus:border-purple-500 border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <div class="mt-1">
                                <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-purple-500 focus:border-purple-500 border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Portfolio-Maker</h3>
                    <p class="mt-4 text-sm text-gray-300">
                        Des templates de portfolio personnalisables pour tous les professionnels et créatifs.
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Navigation</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#features" class="text-sm text-gray-300 hover:text-white">Fonctionnalités</a></li>
                        <li><a href="#templates" class="text-sm text-gray-300 hover:text-white">Modèles</a></li>
                        <li><a href="#how-it-works" class="text-sm text-gray-300 hover:text-white">Comment ça marche</a></li>
                        <li><a href="#contact" class="text-sm text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Légal</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-sm text-gray-300 hover:text-white">Mentions légales</a></li>
                        <li><a href="#" class="text-sm text-gray-300 hover:text-white">Confidentialité</a></li>
                        <li><a href="#" class="text-sm text-gray-300 hover:text-white">CGU</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Suivez-nous</h3>
                    <div class="mt-4 flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between">
                <p class="text-sm text-gray-400">
                    &copy; 2023 Portfolio-Maker. Tous droits réservés.
                </p>
                <div class="mt-4 md:mt-0">
                    <p class="text-sm text-gray-400">
                        Fait avec <i class="fas fa-heart text-red-400"></i> pour les créatifs
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Simple animation for template cards on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeIn');
                }
            });
        }, {threshold: 0.1});

        document.querySelectorAll('.template-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>