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
    <link rel="stylesheet" href="style/inscription_ancien.css">
</head>

<body>
    <!-- Header -->
    <?php
        require_once 'header.php';
    ?>

    <!-- Main Content -->
    <div class="formulaire">
        <h1>Page d'inscription</h1>
        <form action='inscription.php' method="POST">
            <div class="input-formulaire">
                <label for="nom">Nom</label>
                <input type="text" id="nom" placeholder="Entrez votre nom" required>
                <span class="line"></span>
            </div>

            <div class="input-formulaire">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" placeholder="Entrez votre prénom" required>
                <span class="line"></span>
            </div>

            <div class="input-formulaire">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Entrez votre email" required>
                <span class="line"></span>
            </div>

            <div class="input-formulaire">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" placeholder="Entrez un mot de passe" required>
                <span class="line"></span>
            </div>

            <button type="submit">Inscription</button>
        </form>
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
