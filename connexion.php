<?php
if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['email']) && isset($_POST['motdepasse'])) {
    try{
        require_once 'connexion_base_Donnee.php';
        require_once 'functions.php';
        if(seConnecter($connexion))
        {
            header('Location: index.php');
        }
    }catch(Exception $e){
        echo'Erreur : '. $e->getMessage();
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
    <title>Connexion</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/connexion.css">
</head>

<body>
    <!-- Header -->
    <?php
        require_once 'header.php';
    ?>

    <!-- Main Content -->
    <div class="login-container">
        <h1>CONNEXION</h1>
        <form action="connexion.php" method="POST">
            <label for="email">E-Mail</label>
            <input name='email' type="text" id="email" placeholder="Entrez votre e-mail" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="motdepasse" name='motdepasse' placeholder="Entrez votre mot de passe" required>

            <button type="submit">Connexion</button>
        </form>
        <a href="#" class="forgot-password">Mot de passe oublié?</a>
        <p class="signup-text">Pas encore de compte? <a href="inscription.php" class="signup-link">S'inscrire</a></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleMenuButton = document.getElementById('toggleButton');
            const menu = document.querySelector('.menu');

            if (toggleMenuButton && menu) {
                toggleMenuButton.addEventListener('click', function() {
                    menu.classList.toggle('active');
                });
            }
        });
    </script>

    <?php
    require_once 'footer.php';
    ?>
</body>

</html>
