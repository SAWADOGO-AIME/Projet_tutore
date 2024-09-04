<?php
session_start();
?>
<?php
    require_once 'connexion_base_Donnee.php';
    $resultat_req = $connexion->query('SELECT * FROM salle LIMIT 3');

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/index.css">
</head>

<body>
    <!-- Header -->
    <?php
        require_once 'header.php';
    ?>
    <!-- SearchBar Section -->
    <div class="SearchBar">
        <!-- Search Site -->
        <input class="SearchInputSite" type="text" placeholder="Rechercher ...">
        <button class="searchButtonSite"><img src="img/loupe.png" alt="Search"></button>
        
        </div>
    <!--page design-->
    <div class="batiment">
        <div class="text">
            <h1>Bienvenue sur la plateforme</h1>
            <h2>Gestion des salles dans UNB</h2>
            <div class="search">
                <p>Vous recherchez une salle ?</p>
                <a href="salles.php" class="link">→</a>
            </div>
        </div>
        <div class="imagesection">
            <img src="img/UNB.jpg" alt="recherche salle" class="image">
        </div>
    </div>
    <div class="div_text">
        <h2>Faites vos réservations de salles en un clic !</h2>
    </div>
    <div class="container">
        <h1>Salles disponibles</h1>
        <table>
            <thead>
                <tr>
                    <th>Salle(site)</th>
                    <th>Actions rapides</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultat_req->fetchAll(PDO::FETCH_ASSOC) as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nom_salle']) ?><span class="site">(INSSA)</span> <span class="status"> &emsp; &dotsquare; <?= htmlspecialchars($row['emplacement']) ?></span></td>
                    <td>
                        <button class="details"><a href="details.php?SalleNumero=<?=$row['id_salle']?>"><img src="img/detail.png" alt="icone_detail"> Détails</a></button>
                        <button class="reservation"><a href="reservation_rapide.php?SalleNumero=<?=$row['id_salle']?>"><img src="img/reservation.png" alt="iconde reservation"> Réservation rapide</a></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="salles.php" class="view-all">Voir tout...</a>
    </div>



    <div class="div_text" >
        <h2>Liste des réservations que vous avez effectuée</h2>
    </div>

    <!-- Ce bloc s'affiche uniquement si on est connecter -->
    <div class="si_connecter">
    <h1>Vos réservations</h1>
    <div class="grid-container">

        <div class="room-card active">
            <div class="card-header">
                <img src="img/icon.png" alt="icon" class="icon">
                <h2>Pavillon A</h2>
            </div>
            <div class="card-content">
                <p>Site: INSSA</p>
                <p>Heure de début: 08h</p>
                <p>Heure de fin: 12h</p>
                <button class="liberate-button"><img src="img/cross.png" alt="Croix blanche"> Libérer</button>
            </div>
        </div>

        <div class="room-card">
            <div class="card-header">
                <img src="img/icon.png" alt="icon" class="icon">
                <h2>Pavillon B</h2>
            </div>
            <div class="card-content">
                <p>Site: INSSA</p>
                <p>Heure de début: 08h</p>
                <p>Heure de fin: 12h</p>
                <button class="liberate-button"><img src="img/cross.png" alt="Croix blanche"> Libérer</button>
            </div>
        </div>

        <div class="room-card">
            <div class="card-header">
                <img src="img/icon.png" alt="icon" class="icon">
                <h2>Amphi II</h2>
            </div>
            <div class="card-content">
                <p>Site: INSSA</p>
                <p>Heure de début: 08h</p>
                <p>Heure de fin: 12h</p>
                <button class="liberate-button"><img src="img/cross.png" alt="Croix blanche"> Libérer</button>
            </div>
        </div>

        <div class="room-card">
            <div class="card-header">
                <img src="img/icon.png" alt="icon" class="icon">
                <h2>Bloc pédagogique</h2>
            </div>
            <div class="card-content">
                <p>Site: INSSA</p>
                <p>Heure de début: 08h</p>
                <p>Heure de fin: 12h</p>
                <button class="liberate-button"><img src="img/cross.png" alt="Croix blanche"> Libérer</button>
            </div>
        </div>

    </div>
    </div>

<!--ACTUALITES-->
<div class="actualites">
    <div class="card-container">
        <div class="card grande-card">
            <img src="img/actualite.jpg" alt="">
            
            
            <p>ESI acceuille une fois de plus les nouveaux bacheliers pour la rentrée en octobre 2024</p>
        </div>
        <div class="card petite-card">
            <img src="img/salibrite.webp" alt="">
            <p>Journée de salibrité sur le site du 22 prevue à une date ulterieure</p>
        </div>
        <div class="card petite-card">
            <img src="img/etudiant.jpg" alt="">
            <p>Guide de la rentrée étudiante 2024</p>
        </div>
    </div>
    <a href="#" class="all-news-button">TOUTE L'ACTUALITÉ</a>
</div>

<section class="inf">
       <!-- Newsletter Signup Section -->
       <section class="newsletter-section">
        <div class="newsletter-container">
            <div class="newsletter-content">
                <img src="img/NEWS.jpg" alt="Newsletter Image">
                <div class="newsletter-text">
                    <h2>INSCRIVEZ-VOUS À LA NEWSCAMPUS</h2>
                    <p>POUR RECEVOIR LES ACTUALITÉS</p>
                    <form class="newsletter-form" method="POST" action="newsletter.php">
                        <input type="email" placeholder="Entrez votre adresse mail" required>
                        <button type="submit">JE M'INSCRIS</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Boxes Section -->
    <section class="info-section">
        <h3>POUR VOUS AIDER</h3>
        <p>LES OUTILS CAMPUS</p>
        <div class="info-boxes">
            <div class="info-box">
                <i class="icon icon-faq"></i>
                <a href="#"><h4>FAQ</h4></a>
            </div>
            <div class="info-box">
                <i class="icon icon-dossiers"></i>
                <a href="#"><h4>DOSSIERS THÉMATIQUES</h4></a>
            </div>
            <div class="info-box">
                <i class="icon icon-resources"></i>
                <a href="#"><h4>RESSOURCES DOCUMENTAIRES</h4></a>
            </div>
        </div>
    </section>
</section>





    <script>
        // JavaScript for Toggle Menu
document.addEventListener("DOMContentLoaded", function() {
    const toggleMenu = document.querySelector(".toggle_menu");
    const navMenu = document.querySelector(".nav");

    toggleMenu.addEventListener("click", function() {
        navMenu.classList.toggle("active");
    });
});

    </script>

<?php
    require_once 'footer.php';
    ?>
</body>

</html>
