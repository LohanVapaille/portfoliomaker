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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="styles_index.css"> 
</head> 
<body> 
    <!-- Navigation --> 
    <header>
        <div class="container nav-container">
            <div class="logo">
                <i class="fas fa-palette"></i>
                <span>Portfolio<span class="text-purple">Maker</span></span>
            </div>
            
            <nav class="nav-links">
                <a href="#features">Fonctionnalités</a>
                <a href="#templates">Modèles</a>
                <a href="#how-it-works">Comment ça marche</a>
                <a href="#contact">Contact</a>
            </nav>
            
            <div class="flex items-center gap">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="logout.php" class="mr-4">Se déconnecter</a>
                    <a href="portfolio.php?id=<?php echo $id_user?>" class="btn btn-primary">Mon portfolio</a>
                <?php } else { ?>
                    <a href="inscription.php" class="mr-4">S'inscrire</a>
                    <a href="login.php" class="btn btn-primary">Se connecter</a>
                <?php } ?>
            </div>
        </div>
    </header>

    <!-- Hero Section --> 
    <section class="hero">
        <div class="container flex flex-col items-center  ">
            <h1>Créez votre portfolio <span>en quelques minutes</span></h1>
            <p>Portfolio-Maker vous offre des templates modernes et personnalisables pour mettre en valeur votre travail et vos compétences.</p>
            <div class="hero-buttons">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="portfolio.php?id=<?php echo $id_user?>" class="hero-btn hero-btn-primary">Mon portfolio</a>
                <?php } else { ?>
                    <a href="login.php" class="hero-btn hero-btn-primary">Se connecter</a>
                <?php } ?>
                <a href="backoffice.php" class="hero-btn hero-btn-secondary">Accéder au backoffice</a>
            </div>
        </div>
    </section>

    <!-- Features Section --> 
    <section id="features" class="py-16 bg-white">
        <div class="container">
            <div class="text-center">
                <p class="section-title">Fonctionnalités</p>
                <h2 class="section-heading">Pourquoi choisir Portfolio-Maker ?</h2>
                <p class="section-description">Des solutions simples pour une présentation professionnelle</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h3 class="feature-title">Personnalisation facile</h3>
                    <p class="feature-description">Modifiez les couleurs, polices et contenus en quelques clics sans aucune compétence technique.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">Responsive design</h3>
                    <p class="feature-description">Tous nos templates s'adaptent parfaitement à tous les écrans, du smartphone à l'ordinateur.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-house"></i>
                    </div>
                    <h3 class="feature-title">Hébergement gratuit</h3>
                    <p class="feature-description">Profitez d'un hébergement en ligne gratuit pour votre portfolio, sans frais cachés.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="feature-title">Rapide à mettre en place</h3>
                    <p class="feature-description">Personnalisez et déployez votre portfolio facilement grâce à notre interface intuitive.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Templates Section --> 
    <section id="templates" class="py-16 bg-gray">
        <div class="container flex flex-col items-center">
            <div class="text-center">
                <p class="section-title">Nos modèles</p>
                <h2 class="section-heading">Choisissez votre style</h2>
                <p class="section-description">Plus de 10 designs modernes et épurés à venir pour tous les profils et d'autres à venir.</p>
            </div>

            <div class="templates-grid">
                <!-- Template 1 -->
                <div class="template-card">
                    <div class="template-image">
                        <img src="<?php echo $styles['1']['apercu']?>" alt="aperçu simpliste" />
                    </div>
                    <div class="template-overlay">
                        <a href="backoffice.php" class="template-btn">Choisir</a>
                    </div>
                    <div class="template-content">
                        <h3 class="template-title">Minimaliste</h3>
                        <p class="template-description">Design épuré mettant en avant votre contenu sans distractions.</p>
                        <div class="template-tags">
                            <span class="tag">#simple</span>
                            <span class="tag">#élégant</span>
                        </div>
                    </div>
                </div>

                <!-- Template 2 -->
                <div class="template-card">
                    <div class="template-image">
                        <img src="<?php echo $styles['0']['apercu']?>" alt="aperçu simpliste" />
                    </div>
                    <div class="template-overlay">
                        <a href="backoffice.php" class="template-btn">Choisir</a>
                    </div>
                    <div class="template-content">
                        <h3 class="template-title">Professionnel</h3>
                        <p class="template-description">Structure idéale pour les freelances et professionnels expérimentés.</p>
                        <div class="template-tags">
                            <span class="tag">#simple</span>
                            <span class="tag">#élégant</span>
                        </div>
                    </div>
                </div>

                <!-- Template 3 -->
                <div class="template-card">
                    <div class="template-image">
                        <img src="<?php echo $styles['4']['apercu']?>" alt="aperçu simpliste" />
                    </div>
                    <div class="template-overlay">
                        <a href="backoffice.php" class="template-btn">Choisir</a>
                    </div>
                    <div class="template-content">
                        <h3 class="template-title">Créatif</h3>
                        <p class="template-description">Pour les artistes et designers qui veulent sortir du cadre.</p>
                        <div class="template-tags">
                            <span class="tag">#artistique</span>
                            <span class="tag">#unique</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="allstyles.php" class="btn btn-primary">Voir tous les modèles</a>
            </div>
        </div>
    </section>

    <!-- How it works --> 
    <section id="how-it-works" class="py-16 bg-white">
        <div class="container">
            <div class="text-center">
                <p class="section-title">Comment ça marche</p>
                <h2 class="section-heading">En 3 étapes simples</h2>
            </div>

            <div class="steps-container">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3 class="step-title">Créez votre compte</h3>
                        <p class="step-description">Créez votre compte et accédez à notre backoffice et notre bibliothèque de templates</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3 class="step-title">Personnalisez</h3>
                        <p class="step-description">Modifiez le contenu, les couleurs et les images directement dans le backoffice.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3 class="step-title">Déployez</h3>
                        <p class="step-description">Le portfolio est automatiquement hébergé en ligne, prêt à être partagé avec le monde.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section --> 
    <section id="download" class="cta">
        <div class="container">
            <div class="cta-content">
                <div class="cta-text">
                    <h2>
                        <span>Prêt à créer votre portfolio ?</span>
                        <span>Téléchargez votre template dès maintenant.</span>
                    </h2>
                </div>
                <div class="cta-buttons">
                    <a href="allstyles.php" class="btn btn-outline">Choisir son style</a>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <a href="portfolio.php?id=<?php echo $id_user?>" target="_blank" class="btn btn-primary">Mon portfolio</a>
                    <?php } else { ?>
                        <a href="login.php" class="btn btn-primary">Se connecter</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section --> 
    <section id="contact" class="py-16 bg-white">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading">Des questions ?</h2>
                <p class="section-description">Contactez notre équipe pour plus d'informations</p>
            </div>

            <div class="contact-form">
                <form class="space-y-8">
                    <div class="form-group">
                        <label for="name" class="form-label">Nom complet</label>
                        <input id="name" name="name" type="text" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" rows="4" required class="form-input form-textarea"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Envoyer le message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer --> 
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 class="footer-title">Portfolio-Maker</h3>
                    <p class="footer-text">Des templates de portfolio personnalisables pour tous les professionnels et créatifs.</p>
                </div>
                <div>
                    <h3 class="footer-title">Navigation</h3>
                    <ul class="footer-links">
                        <li><a href="#features">Fonctionnalités</a></li>
                        <li><a href="#templates">Modèles</a></li>
                        <li><a href="#how-it-works">Comment ça marche</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Légal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Mentions légales</a></li>
                        <li><a href="#">Confidentialité</a></li>
                        <li><a href="#">CGU</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Suivez-moi</h3>
                    <div class="footer-social">
                        <a href="https://www.facebook.com/profile.php?id=100010968216968" target='_blank'><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/lohan.696/" target='_blank'><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/LohanVapaille" target='_blank'><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="copyright">&copy; 2025 Portfolio-Maker. Tous droits réservés.</p>
                <p class="made-with-love">Fait avec <i class="fas fa-heart"></i> pour les créatifs</p>
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