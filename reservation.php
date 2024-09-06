<?php
session_start();
require_once 'functions.php';
require_once 'connexion_base_Donnee.php';
if (isset($_GET['barre_rechercher_site'])) {

}
else if(isset($_GET['barre_rechercher_salle'])) {

}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Réservation</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/reservation.css">
</head>

<body>
    <!-- Header -->
    <?php
        require_once 'header.php';
    ?>

    <!-- SearchBar Section -->
    <div class="SearchBar">
        <!-- Search Site -->
        <form action="reservation.php" method="GET">
            <input type="text" name="barre_rechercher_site" id="barre_rechercher_site" placeholder="Rechercher site">
            <button type="submit" class="searchButtonSite"><img src="img/loupe_black.png" alt="Search"></button>
        </form>
        <!-- Search Salle -->
        <!-- <p>👈🏿---------👉🏿</p> -->
        <form action="reservation.php" method="GET">
            <input type="text" name="barre_rechercher_salle" id="barre_rechercher_salle" placeholder="Rechercher salle">
            <button type="submit" class="searchButtonSalle"><img src="img/loupe_black.png" alt="Search"></button>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <?php
            if(!isset($_SESSION['connecter'])){
                echo '<div id="message">';
                echo '<h3>';
                echo 'Veuillez vous connecter pour voir vos réservations';
                echo '</h3>';
                echo '<p>Cliquez ici : <a href="connexion.php">Se connecter</a></p>';
                echo '</div>';
            }
            else{
                $tableauFetch = getReservation($connexion);
                if(!$tableauFetch){
                    echo '<div id="message">';
                    echo '<h3>';
                    echo "Vous n'avez encore fait aucune réservation";
                    echo '</h3>';
                    echo '<p>Cliquez ici pour en faire une : <a href="salles.php">Voir salles</a></p>';
                    echo '</div>';
                }
                else{
                    // $preparation = $connexion->prepare('SELECT * FROM salle ORDER BY emplacement');

                    if (isset($_GET['barre_rechercher_salle'])) {
                        $tableauFetch= getReservationbySalles($connexion);
                    }
                    else if (isset($_GET['barre_rechercher_site'])) {
                        $tableauFetch= getReservationbySites($connexion);
                    }
                    if($tableauFetch<>null){
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Nom de la Salle</th>";
                    echo "<th>Site</th>";
                    echo "<th>Jour reservé</th>";
                    echo "<th>Heure Debut</th>";
                    echo "<th>Heure Fin</th>";
                    echo "<th>Actions</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    foreach($tableauFetch as $colonne){
                    echo "<tr>";
                    echo "<td>";
                    echo htmlspecialchars($colonne['nom_salle']);
                    echo "</td>";
                    echo "<td>";
                    echo htmlspecialchars($colonne['emplacement']);
                    echo "</td>";
                    echo "<td>";
                    echo htmlspecialchars($colonne['jour_reserver']);
                    echo "</td>";
                    echo "<td>";
                    echo htmlspecialchars($colonne['heure_debut']);
                    echo "</td>";
                    echo "<td>";
                    echo htmlspecialchars($colonne['heure_fin']);
                    echo "</td>";

                    echo "<td>";
                    
                    echo "<a href=\"details.php?SalleNumero=" .htmlspecialchars($colonne['id_salle']). "\"><button>Voir salle</button></a>";
                    echo "<a href=\"liberer_salle.php?Salle_a_Liberer=" .htmlspecialchars($colonne['id_reservation']) ."\"><button>Libérer</button></a>";
                    echo "</td>";
                    echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    }
                    else{
                        echo '<div id="message">';
                        echo '<h3>';
                        echo "Aucun résultat trouver";
                        // echo '</h3>';
                        // echo '<p>Cliquez ici pour en faire une : <a href="salles.php">Voir salles</a></p>';
                        echo '</div>';
                    }
                }
            }
        ?>
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

