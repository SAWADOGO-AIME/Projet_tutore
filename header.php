<?php
    echo '<header>';
    echo '<div class="logo">';
        echo '<a href="index.php"><img src="img/logo.png" alt="Logo"></a>';
    echo '</div>';
    echo '<!-- Navigation Menu -->';
    echo '<nav class="nav">';
        echo '<ul class="menu">';
            echo '<li><a href="index.php"><b>Accueil</b></a></li>';
            echo '<li><a href="salles.php"><b>Salles</b></a></li>';
            echo '<li><a href="reservation.php"><b>Réservations</b></a></li>';
            echo '<li><a href="contacts.php"><b>Contacts</b></a></li>';
        echo '</ul>';
    echo '</nav>';
    echo '<div class="connexion">';
    if (isset($_SESSION['connecter']) and $_SESSION['connecter']==true)
        echo '<button class="ConnexionButton"><a href="deconnexion.php">Déconnexion</a></button>';
    else
        echo '<button class="ConnexionButton"><a href="connexion.php">Connexion</a></button>';
    echo '</div>';
    echo '<!-- Toggle Menu for Small Screens -->';
    echo '<div class="toggle_menu">';

    echo '</div>';
echo '</header>';
?>