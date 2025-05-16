<?php 
require 'require.php'; // Connexion à la BDD
session_start();

$user = null; // Par défaut aucun user

// Si un ID est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_user = $_GET['id']; // sécurisation

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
    

    if (!empty($info_principales['id_css'] )) {
    $selected_css = $info_principales['id_css'];
    $stmt = $pdo->prepare("SELECT * FROM styles_css WHERE id_css = ?");
    $stmt->execute([$selected_css]);
    $style = $stmt->fetch(PDO::FETCH_ASSOC);}
    else {
        $stmt = $pdo->query("SELECT * FROM styles_css WHERE id_css = 2");
        $style = $stmt->fetch(PDO::FETCH_ASSOC);
    }


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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
    <style>/* Popup Styles */
.popup {
    position: fixed;
    top: 100px;
    right: 100px;
    width: 300px;
    background: white;
    border: 2px solid #333;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
    z-index: 1000;
    border-radius: 10px;
    overflow: hidden;
}

.popup-header {
    cursor: move;
    background: #222;
    color: white;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
}

.popup-header button {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

.popup-body {
    padding: 15px;
    
}

#reopen-popup {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: #222;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    z-index: 1000;
}</style>
    <link rel="stylesheet" href="styles/<?php if (!empty($style['nom'])) {
                        echo htmlspecialchars($style['nom']);
                    } else {
                        echo 'default';
                    }?>.css" id="portfolio-style">
                    
</head>

<body>
    <?php if (isset($_GET['id']) && $user) { 
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $_GET['id']) { ?>
            <div id="draggable-popup" class="popup">
                <div class="popup-header">
                    <h2>Vous êtes sur votre portfolio personnel</h2>
                    <button id="minimize-btn">–</button>
                </div>
                <div class="popup-body">
                    <p>Si vous souhaitez le modifier, rendez-vous sur le backoffice</p>
                    <a href='backoffice.php' class='btn'>Accéder au backoffice</a>
                </div>
            </div>
            <div id="reopen-popup" style="display: none;">📂 Réouvrir</div>
        <?php } 
    } else { 
        echo "Aucun utilisateur spécifié. Voici le modèle de base du portfolio ✨"; 
    } ?>
    
    <header id="header">
        <div class="container header">
            <div id="logo">
                <h1><span id="firstname"><?php echo $user['prenom']; ?></span> <span id="lastname"> <?php 
                        if (!empty($user['nom'])) {
                            echo $user['nom'];
                        } else {
                            echo '';
                        }
                     ?></span></h1>
                <p id="job-title"><?php 
                    if (!empty($info_principales['metier'])) {
                        echo htmlspecialchars($info_principales['metier']);
                    } else {
                        echo 'Poste/métier non renseigné';
                    }
                ?></p>
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
                <h2 id="hero-title">
                    <?php 
                    if (!empty($section_about['titre_accueil'])) {
                        echo htmlspecialchars($section_about['titre_accueil']);
                    } else {
                        echo 'Bienvenue sur mon portfolio !';
                    }
                ?></h2>
                <p id="hero-subtitle"><?php 
                    if (!empty($section_about['phrase_accroche'])) {
                        echo htmlspecialchars($section_about['phrase_accroche']);
                    } else {
                        echo 'Découvrez mon travail et mes compétences';
                    }
                ?></p>
                <a href="#portfolio" class="btn" id="view-work-btn">Voir mes projets</a>
            </div>
            <div id="hero-image">
                <img src="<?php 
                    if (!empty($info_principales['imagepp'])) {
                        echo $info_principales['imagepp'];
                    } else {
                        echo 'https://img.freepik.com/vecteurs-premium/illustration-vectorielle-plate-echelle-gris-avatar-profil-utilisateur-icone-personne-image-profil-silhouette-neutre-genre-convient-pour-profils-medias-sociaux-icones-economiseurs-ecran-comme-modelex9xa_719432-2210.jpg';
                    }
                ?>" alt="Photo de profil" id="profile-pic">
            </div>
        </div>
    </section>
    
    <!-- Section A propos -->
    <section id="about">
        <div class="container">
            <div id="about-content">
                <div id="about-text">
                    <h2 class="section-title">À propos de moi</h2>
                    <p id="about-description"><?php 
                        if (!empty($section_about['apropos'])) {
                            echo htmlspecialchars($section_about['apropos']);
                        } else {
                            echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.';
                        }
                    ?></p>
                    
                    <div id="personal-info">
                        <ul>
                            <li><span class="info-label">Âge : </span> <span id="age"><?php 
                                if (!empty($user['age'])) {
                                    echo htmlspecialchars($user['age']);
                                } else {
                                    echo 'Non renseigné';
                                }
                            ?></span></li>
                            <li><span class="info-label">Localisation :</span> <span id="location"><?php 
                                if (!empty($info_principales['localisation'])) {
                                    echo htmlspecialchars($info_principales['localisation']);
                                } else {
                                    echo 'Non renseigné';
                                }
                            ?></span></li>
                            <li><span class="info-label">Email :</span> <a id="email" href="mailto:<?php 
                                if (!empty($section_contact['mail_contact'])) {
                                    echo htmlspecialchars($section_contact['mail_contact']);
                                } else {
                                    echo $user['email'];
                                }
                            ?>"><?php 
                                if (!empty($section_contact['mail_contact'])) {
                                    echo htmlspecialchars($section_contact['mail_contact']);
                                } else {
                                    echo $user['email'];
                                
                                }
                            ?></a></li>
                            <li><span class="info-label">Téléphone :</span> <a id="tel" href="tel:<?php 
                                if (!empty($info_principales['telephone'])) {
                                    echo htmlspecialchars($info_principales['telephone']);
                                } else {
                                    echo 'Non renseigné';
                                }
                            ?>"><?php 
                                if (!empty($info_principales['telephone'])) {
                                    echo htmlspecialchars($info_principales['telephone']);
                                } else {
                                    echo 'Non renseigné';
                                }
                            ?></a></li>
                        </ul>
                    </div>
                </div>
                
                <div id="social">
                    <ul>
                        <li><a href="https://www.linkedin.com/in/lohan-vapaille-1b3968318/" class="social-link" target='_blank'><i class='bx bxl-linkedin'></i></a></li>
                        <li><a href="https://github.com/LohanVapaille" class="social-link" target='_blank'><i class='bx bxl-github'></i></a></li>
                        <li><a href="https://lohanvapaille.fr" class="social-link" target='_blank'><i class='bx bx-globe'></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Section Compétences -->
    <section id="skills">
        <div class="container">
            <h2 class="section-title">Mes compétences</h2>
            <?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_user = $_GET['id'];
    
    $stmt = $pdo->prepare("SELECT * FROM section_competences_categorie WHERE id_user = ?");
    $stmt->execute([$id_user]);
    $section_competences_categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($section_competences_categorie)) {
        foreach ($section_competences_categorie as $categorie) {
            echo '<div class="skill-category">';
            echo '<h3 class="skill-category-title">' . htmlspecialchars($categorie['nom']) . '</h3>';
            echo '<ul class="skills-list">';

            $stmt = $pdo->prepare("SELECT * FROM section_competences WHERE id_categorie = ? AND id_user = ?");
            $stmt->execute([$categorie['id_categorie'], $id_user]);
            $competences = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

            foreach ($competences as $competence) {
                echo '<li class="skill-item">';
                echo '<span class="skill-name">' . htmlspecialchars($competence['nom_competence']) . '</span>';
                echo '<div class="skill-level" data-level="' . htmlspecialchars($competence['pourcent_competence']) . '"></div>';
                echo '</li>';
            }

            echo '</ul>';
            echo '</div>';
        }
    } else {
        echo '<p>Aucune compétence renseignée.</p>';
    }
} else {
    echo '<p>Utilisateur non spécifié.</p>';
}
?>

            
        </div>
    </section>
    
    <!-- Section Portfolio/Projets -->
    <section id="portfolio">
        <div class="container">
            <h2 class="section-title">Mes projets</h2>
            <div id="portfolio-grid">
                <?php 
                $stmt = $pdo->prepare("SELECT * FROM section_projets WHERE id_user = ?");
                $stmt->execute([$id_user]);
                $section_projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($section_projets )) {
                foreach ($section_projets as $projet) { ?>
                    <div class="portfolio-item">
                        <?php if (!empty($projet['image'])) {
                            echo '<img src="' . htmlspecialchars($projet['image']) . '" alt="Projet" class="project-image">';
                        } else {
                            echo '';
                        } ?>
                        
                        <div class="project-info">
                            <h3 class="project-title"><?php echo htmlspecialchars($projet['titre_projet']); ?></h3>
                            <p class="project-description"><?php echo htmlspecialchars($projet['description']); ?></p>
                            <a href="<?php echo htmlspecialchars($projet['lien']); ?>" class="project-link" target="_blank">Voir le projet</a>
                        </div>
                    </div>
                <?php } 
                } else {
                    echo '<p>Aucun projet renseigné.</p>';}
                 ?>
            </div>
        </div>
    </section>
    
    <!-- Section Expérience/Formation -->
    <section id="experience">
        <div class="container">
            <h2 class="section-title">Mon parcours</h2>
            <div id="timeline">
                <?php 
                $stmt = $pdo->prepare("SELECT * FROM section_experiences WHERE id_user = ? ORDER BY annee_debut DESC");
                $stmt->execute([$id_user]);
                $section_experiences = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($section_experiences )) {
                foreach ($section_experiences as $experience) { ?>
                    <div class="timeline-item">
                        <div class="timeline-date"><?php echo $experience['annee_debut'];?> - <?php echo $experience['annee_fin'];?></div>
                        <div class="timeline-content">
                            <h3 class="timeline-title"><?php echo $experience['titre_experience'];?></h3>
                            <p class="timeline-lieu"><?php echo $experience['lieu'];?></p>
                            <p class="timeline-description"><?php echo $experience['description_exp'];?></p>
                        </div>
                    </div>
                <?php } 
                } else {
                    echo '<p>Aucune expérience renseignée</p>';
                } ?>
                
                
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
                            echo htmlspecialchars($section_contact['titre_contact']);
                        } else {
                            echo 'Contactez moi !';
                        }
                    ?></h3>
                    <p id="contact-description"><?php 
                        if (!empty($section_contact['description_contact'])) {
                            echo htmlspecialchars($section_contact['description_contact']);
                        } else {
                            echo 'Contactez-moi en remplissant le formulaire ci-dessous!';
                        }
                    ?></p>
                    
                    <ul id="contact-details">
                        <li><i class='bx bxs-envelope'></i> <span id="contact-email"><?php 
                        if (!empty($section_contact['mail_contact'])) {
                            echo htmlspecialchars($section_contact['mail_contact']);
                        } else {
                            echo $user['email'];
                            
                        }
                    ?>
                    </span></li>
                        <li><i class='bx bxs-phone'></i> <span id="contact-phone"><?php 
                        if (!empty($info_principales['telephone'])) {
                            echo htmlspecialchars($info_principales['telephone']);
                        } else {
                            echo '+33 07 07 07 07 07. ';
                        }
                    ?></span></li>
                        <li><i class='bx bxs-map-pin'></i> <span id="contact-address"><?php 
                        if (!empty($info_principales['localisation'])) {
                            echo htmlspecialchars($info_principales['localisation']);
                        } else {
                            echo 'Où habitez vous ? ';
                        }
                    ?></span></li>
                    </ul>
                </div>
                
                <form id="contact-form" action="mailto:<?php 
                        if (!empty($section_contact['mail_contact'])) {
                            echo htmlspecialchars($section_contact['mail_contact']);
                        } else {
                            echo $user['email'];
                            
                        }
                    ?>" method="POST">
            
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
                    &copy; <span id="current-year">2025</span> <span id="footer-name">Powered by Lohan Vapaille</span>. Tous droits réservés.
                </div>
                
                <div id="footer-links">
                    <a href="#" class="footer-link">Mentions légales</a>
                    <a href="#" class="footer-link">Politique de confidentialité</a>
                </div>
                
                <div id="footer-social">
                    <a href="https://www.linkedin.com/in/lohan-vapaille-1b3968318/" class="social-link" target='_blank'><i class='bx bxl-linkedin'></i></a>
                    <a href="https://github.com/LohanVapaille" class="social-link" target='_blank'><i class='bx bxl-github'></i></a>
                    <a href="https://lohanvapaille.fr" class="social-link" target='_blank'><i class='bx bx-globe'></i></a>
                </div>
            </div>
        </div>
    </footer>
    
    <script>

document.addEventListener('DOMContentLoaded', () => {
    const skillBars = document.querySelectorAll('.skill-level');
    console.log('Skill bars found:', skillBars);  // Vérifie combien de skill-level il y a

    if (skillBars.length === 0) {
        console.log('Aucun élément .skill-level trouvé sur cette page.');
    }

    skillBars.forEach(bar => {
        const level = bar.getAttribute('data-level');
        console.log('Level:', level);  // Vérifie la valeur de level

        if (level) {
            const fill = document.createElement('div');
            fill.classList.add('skill-fill');
            fill.style.width = `${level}%`;
            fill.style.height = '100%';
            fill.style.transition = 'width 1s ease';
            fill.style.borderRadius = '5px';
            bar.appendChild(fill);
        }
    });
});
    // Draggable popup functionality
    const popup = document.getElementById('draggable-popup');
    const header = popup.querySelector('.popup-header');
    const minimizeBtn = document.getElementById('minimize-btn');
    const reopenPopup = document.getElementById('reopen-popup');
    
    let offsetX, offsetY, isDragging = false;
    
    header.addEventListener('mousedown', function(e) {
        isDragging = true;
        offsetX = e.clientX - popup.offsetLeft;
        offsetY = e.clientY - popup.offsetTop;
    });
    
    document.addEventListener('mouseup', () => {
        isDragging = false;
    });
    
    document.addEventListener('mousemove', function(e) {
        if (isDragging) {
            popup.style.left = (e.clientX - offsetX) + 'px';
            popup.style.top = (e.clientY - offsetY) + 'px';
        }
    });
    
    minimizeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
        reopenPopup.style.display = 'block';
    });
    
    reopenPopup.addEventListener('click', () => {
        popup.style.display = 'block';
        reopenPopup.style.display = 'none';
    });
    



    
    // Current year in footer
    document.getElementById('current-year').textContent = new Date().getFullYear();
    </script>
</body>
</html>