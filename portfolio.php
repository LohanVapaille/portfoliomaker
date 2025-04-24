<?php 
require 'require.php'; // Connexion à la BDD
session_start();

$user = null; // Par défaut aucun user

// Si un ID est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_user = intval($_GET['id']); // sécurisation

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare("SELECT * FROM infos_principales WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $info_principales = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM section_about WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $section_about = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM section_contact WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $section_contact = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    $stmt = $pdo->prepare("SELECT * FROM section_competences_categorie WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $section_competences_categorie = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM section_competences WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $section_competences = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM section_projets WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $section_projets = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM section_experiences WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $section_experiences = $stmt->fetch(PDO::FETCH_ASSOC);
    



}

else{

    $stmt = $pdo->query("SELECT * FROM users WHERE id_user = 0");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

// var_dump($user)
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio</title>
    <!-- Lien vers le fichier CSS qui sera choisi par l'utilisateur -->
    <link rel="stylesheet" href="/portfoliomaker/styles/default.css" id="portfolio-style">
</head>
<body>

<?php 
if (isset($_GET['id']) && $user) {
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']) {
        echo "C'est ton propre portfolio 👤";
    } else {
        echo "Tu consultes le portfolio de quelqu'un d'autre 👀";
    }
} else {
    echo "Aucun utilisateur spécifié. Voici le modèle de base du portfolio ✨";
}
?>

    <header id="header">
        <div class="container header">
            <div id="logo">
                <h1><span id="firstname">
                <?php echo $user['prenom']; ?>

                </span> <span id="lastname"><?php echo $user['nom'];  ?>
                </span></h1>
                <p id="job-title">Poste/Métier</p>
            </div>
            
            <nav id="main-nav">
                <ul>
                    <li><a href="#about" class="nav-link">À propos</a></li>
                    <li><a href="#skills" class="nav-link">Compétences</a></li>
                    <li><a href="#portfolio" class="nav-link">Projets</a></li>
                    <li><a href="#experience" class="nav-link">Expérience</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Section Hero/Banniere -->
    <section id="hero">
        <div class="container welcome">
            <div id="hero-content">
                <h2 id="hero-title">Bienvenue sur mon portfolio</h2>
                <p id="hero-subtitle">Découvrez mon travail et mes compétences</p>
                <a href="#portfolio" class="btn" id="view-work-btn">Voir mes projets</a>
            </div>
            <div id="hero-image">
    <img 
        src="<?php
            if (!empty($info_principales['imagepp'])) {
                echo $info_principales['imagepp'];
            } else {
                echo 'https://img.freepik.com/vecteurs-premium/illustration-vectorielle-plate-echelle-gris-avatar-profil-utilisateur-icone-personne-image-profil-silhouette-neutre-genre-convient-pour-profils-medias-sociaux-icones-economiseurs-ecran-comme-modelex9xa_719432-2210.jpg';
            }
        ?>" 
        alt="Photo de profil" 
        id="profile-pic"
    >
</div>

        </div>
    </section>

    <!-- Section A propos -->
    <section id="about">
        <div class="container">
            <h2 class="section-title"><?php
                                if (!empty($section_about['titre_accueil'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_about['titre_accueil']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Non renseigné';
                                }
                              ?></h2>
            <div id="about-content">
                <div id="about-text">
                    <p id="about-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
                    
                    <div id="personal-info">
                        <ul>
                            <li><span class="info-label">Âge : </span> <span id="age">30</span></li>
                            <li><span class="info-label">Localisation :</span> <span id="location">
                                <?php
                                if (!empty($info_principales['localisation'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($info_principales['localisation']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Non renseigné';
                                }
                              ?></span></li>
                            <li><span class="info-label">Email :</span> <a id="email" href="mailto:<?php
                                if (!empty($section_contact['mail_contact'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_contact['mail_contact']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Non renseigné';
                                }
                              ?>">
                              <?php
                                if (!empty($section_contact['mail_contact'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_contact['mail_contact']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Non renseigné';
                                }
                              ?></a></li>
                            <li><span class="info-label">Téléphone :</span> <a id="email" href="tel:<?php
                                if (!empty($info_principales['telephone'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($info_principales['telephone']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Non renseigné';
                                }
                              ?>"><?php
                                if (!empty($info_principales['telephone'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($info_principales['telephone']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Non renseigné';
                                }
                              ?></a></li>
                        </ul>
                    </div>
                </div>
                
                <div id="social-links">
                    <a href="#" class="social-link" id="linkedin-link"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-link" id="github-link"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-link" id="twitter-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link" id="dribbble-link"><i class="fab fa-dribbble"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Compétences -->
    <section id="skills">
        <div class="container">
            <h2 class="section-title">Mes compétences</h2>
            
            <div id="skills-container">
                <div class="skill-category">
                    <h3 class="skill-category-title">Développement</h3>
                    <ul class="skills-list">
                        <li class="skill-item">
                            <span class="skill-name">HTML/CSS</span>
                            <div class="skill-level" data-level="90"></div>
                        </li>
                        <li class="skill-item">
                            <span class="skill-name">JavaScript</span>
                            <div class="skill-level" data-level="80"></div>
                        </li>
                        <li class="skill-item">
                            <span class="skill-name">PHP</span>
                            <div class="skill-level" data-level="70"></div>
                        </li>
                    </ul>
                </div>
                
                <div class="skill-category">
                    <h3 class="skill-category-title">Design</h3>
                    <ul class="skills-list">
                        <li class="skill-item">
                            <span class="skill-name">UI/UX</span>
                            <div class="skill-level" data-level="85"></div>
                        </li>
                        <li class="skill-item">
                            <span class="skill-name">Photoshop</span>
                            <div class="skill-level" data-level="75"></div>
                        </li>
                        <li class="skill-item">
                            <span class="skill-name">Illustrator</span>
                            <div class="skill-level" data-level="65"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Portfolio/Projets -->
    <section id="portfolio">
        <div class="container">
            <h2 class="section-title">Mes projets</h2>
            
            <div id="portfolio-filters">
                <button class="filter-btn active" data-filter="all">Tous</button>
                <button class="filter-btn" data-filter="web">Web</button>
                <button class="filter-btn" data-filter="design">Design</button>
                <button class="filter-btn" data-filter="mobile">Mobile</button>
            </div>
            
            <div id="portfolio-grid">
                <div class="portfolio-item" data-category="web">
                    <img src="images/project1.jpg" alt="Projet 1" class="project-image">
                    <div class="project-info">
                        <h3 class="project-title">Site Web E-commerce</h3>
                        <p class="project-description">Développement d'une boutique en ligne avec système de paiement</p>
                        <a href="#" class="project-link">Voir le projet</a>
                    </div>
                </div>
                
                <div class="portfolio-item" data-category="design">
                    <img src="images/project2.jpg" alt="Projet 2" class="project-image">
                    <div class="project-info">
                        <h3 class="project-title">Identité visuelle</h3>
                        <p class="project-description">Création d'une identité visuelle pour une startup</p>
                        <a href="#" class="project-link">Voir le projet</a>
                    </div>
                </div>
                
                <div class="portfolio-item" data-category="mobile">
                    <img src="images/project3.jpg" alt="Projet 3" class="project-image">
                    <div class="project-info">
                        <h3 class="project-title">Application Mobile</h3>
                        <p class="project-description">Développement d'une application de fitness</p>
                        <a href="#" class="project-link">Voir le projet</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Expérience/Formation -->
    <section id="experience">
        <div class="container">
            <h2 class="section-title">Mon parcours</h2>
            
            <div id="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">2020 - Présent</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Développeur Front-end</h3>
                        <p class="timeline-company">Entreprise ABC</p>
                        <p class="timeline-description">Développement d'interfaces utilisateur pour des applications web.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-date">2018 - 2020</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Designer UI/UX</h3>
                        <p class="timeline-company">Agence XYZ</p>
                        <p class="timeline-description">Conception d'interfaces et expériences utilisateur.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-date">2016 - 2018</div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">Formation Développement Web</h3>
                        <p class="timeline-company">École 123</p>
                        <p class="timeline-description">Diplôme en développement web et mobile.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section id="contact">
        <div class="container">
            <h2 class="section-title">Contactez-moi</h2>
            
            <div id="contact-container">
                <div id="contact-info">
                    <h3 id="contact-subtitle"><?php
                                if (!empty($section_contact['titre_contact'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_contact['titre_contact']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Non renseigné';
                                }
                              ?></h3>
                    <p id="contact-description"><?php
                                if (!empty($section_contact['description_contact'])) {
                                    // Affiche la localisation (sécurisée)
                                    echo htmlspecialchars($section_contact['description_contact']);
                                } else {
                                    // Valeur par défaut si rien n'est renseigné
                                    echo 'Une phrase qui donne explique pourquoi vous contacter. ';
                                }
                              ?></p>
                    
                    <ul id="contact-details">
                        <li><i class="fas fa-envelope"></i> <span id="contact-email">contact@example.com</span></li>
                        <li><i class="fas fa-phone"></i> <span id="contact-phone">+33 6 12 34 56 78</span></li>
                        <li><i class="fas fa-map-marker-alt"></i> <span id="contact-address">Paris, France</span></li>
                    </ul>
                </div>
                
                <form id="contact-form">
                    <div class="form-group">
                        <input type="text" id="name" name="name" placeholder="Votre nom" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Votre email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="subject" name="subject" placeholder="Sujet">
                    </div>
                    <div class="form-group">
                        <textarea id="message" name="message" placeholder="Votre message" required></textarea>
                    </div>
                    <button type="submit" class="btn" id="submit-btn">Envoyer le message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <div id="footer-content">
                <div id="copyright">
                    &copy; <span id="current-year">2023</span> <span id="footer-name">Prénom NOM</span>. Tous droits réservés.
                </div>
                
                <div id="footer-links">
                    <a href="#" class="footer-link">Mentions légales</a>
                    <a href="#" class="footer-link">Politique de confidentialité</a>
                </div>
                
                <div id="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>

        // scripts/main.js

    document.addEventListener('DOMContentLoaded', () => {
        const skillBars = document.querySelectorAll('.skill-level');

        skillBars.forEach(bar => {
            const level = bar.getAttribute('data-level');
            if (level) {
                const fill = document.createElement('div');
                fill.classList.add('skill-fill'); // Ajoute une classe CSS
                fill.style.width = `${level}%`;
                fill.style.height = '100%';
                
                fill.style.transition = 'width 1s ease';
                fill.style.borderRadius = '5px';
                fill.style.marginTop = '-10px'
                bar.appendChild(fill);
            }
        });
    });

        // Fonction pour changer le style CSS
        function changeStyle(styleFile) {
            document.getElementById('portfolio-style').href = 'styles/' + styleFile + '.css';
        }
        
        // Exemple d'utilisation:
        // changeStyle('modern'); chargerait le fichier styles/modern.css
        // changeStyle('minimal'); chargerait le fichier styles/minimal.css
        // etc.
        
        // Filtrage des projets
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                
                // Mettre à jour le bouton actif
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Filtrer les projets
                document.querySelectorAll('.portfolio-item').forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>