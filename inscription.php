<?php
if ($_SERVER['REQUEST_METHOD'] =='POST') {
    try{
        require_once 'connexion_base_Donnee.php';
        require_once 'functions.php';
        if(sInscrire($connexion)){
            header('Location: index.php');
        }
        else{
            echo "<script>alert('Mot de passe different !')</script>";
        }
    }
    catch(Exception $e){
        echo 'Erreur : '. $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/inscription.css">
</head>

<body>
    <!-- Header -->
    <?php
        require_once 'header.php';
    ?>

    <!-- Main Content -->
    <div id="div_central">
            <h1>Inscription</h1>
            <form action="inscription.php" method="post">
                <div class="titre">
                    <label for="nom">Nom</label> <br>
                </div>
                <div class="champ">
                    <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" required>
                </div>
                <div class="titre">
                    <label for="prenom">Prénom(s)</label> <br>
                </div>
                <div class="champ">
                    <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom(s)" required>
                </div>
                <div class="titre">
                    <label for="motdepasse">Mot de passe</label> <br>
                </div>
                <div class="champ">
                    <input type="password" name="motdepasse" id="motdepasse" placeholder="Entrez votre mot de passe" required>
                </div>
                <div class="titre">
                    <label for="motdepasseconfirmation">Confirmer votre mot de passe</label> <br>
                </div>
                <div class="champ">
                    <input type="password" name="motdepasseconfirmation" id="motdepasseconfirmation" placeholder="Réentrez votre mot de passe" required>
                </div>
                <div class="titre">
                    <label for="email">Adresse mail</label> <br>
                </div>
                <div class="champ">
                    <input type="email" name="email" id="email" placeholder="Entrez votre adresse mail" required>
                </div>
                <div id="champ_select">
                    <label for="origine">Etablissement d'origine : </label>
                    <select name="choix_origine" id="choix_origine">
                        <option value="SITE DU 22">SITE DU 22</option>
                        <option value="INSSA">INSSA</option>
                        <option value="CENTRE DE CALCUL">CENTRE DE CALCUL</option>
                    </select>
                </div>
                <div id='bouton_inscription'>
                    <input type="submit" value="S'inscrire">
                </div>
            </form>
            <div id="zone_deja_inscrit">
                <p>Vous avez déjà de compte ? <a href="connexion.php">Se connecter</a></p>
            </div>
        </div>
  
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
