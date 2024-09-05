<?php
session_start();
$tableaufetchsite = null;
$tableaufetchsalle = null;
require_once 'connexion_base_Donnee.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salles</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/salles.css">
</head>

<body>
    <!-- Header -->
    <?php
    require_once 'header.php';
    ?>
    <div id="div_corps_page">
        
        <div id="rechercher_site">

            <div class="champ_rechercher">
                <form action="salles.php" method="GET">
                    <input type="text" name="barre_rechercher_site" id="barre_rechercher_site" placeholder="rechercher site">
                    <button type="submit">
                        <img src="img/loupe_black.png" alt="loupe">
                    </button>
                </form>
            </div>
            <div class="resultat_recherche">
            <?php
                if (!isset($_GET['barre_rechercher_site'])){
                    $preparation = $connexion->prepare('SELECT * FROM salle ORDER BY emplacement');
                    $preparation->execute();
                    $tableaufetchsite = $preparation->fetchAll();
                    foreach ($tableaufetchsite as $colonne) {
                        echo '<div class="resultat_individuel">';
                        echo '<h3>';
                        echo htmlspecialchars($colonne['emplacement']);
                        echo '</h3>';
                        echo '<p>';
                        echo 'Nom de la salle : <span>' . htmlspecialchars($colonne['nom_salle']) . '</span> <br>';
                        echo 'Etat : <span>' . htmlspecialchars($colonne['salle_disponible']) . '</span> <br>';
                        echo 'Nombre de places : <span>' . htmlspecialchars($colonne['nombre_places']) . '</span> <br>';
                        echo '<div id="bouton">';
                        echo '<a href="reservation_rapide.php?SalleNumero='. htmlspecialchars($colonne['id_salle']) .'"><button>Réserver</button></a>';
                        echo '</div>';
                        echo '</p>';
                        echo '</div>';
                    }
                }
                else{
                    $tableaufetchsite = getSites($connexion);
                    if ($tableaufetchsite<>null){
                        foreach ($tableaufetchsite as $colonne) {
                            echo '<div class="resultat_individuel">';
                            echo '<h3>';
                            echo htmlspecialchars($colonne['nom_salle']);
                            echo '</h3>';
                            echo 'Site : <span>' . htmlspecialchars($colonne['emplacement']) . '</span> <br>';
                            echo 'Etat : <span>' . htmlspecialchars($colonne['salle_disponible']) . '</span> <br>';
                            echo '<p>';
                            echo 'Nombre de places : <span>' . htmlspecialchars($colonne['nombre_places']) . '</span> <br>';
                            echo '<div id="bouton">';
                            echo '<a href="reservation_rapide.php?SalleNumero='. htmlspecialchars($colonne['id_salle']) .'"><button>Réserver</button></a>';
                            echo '</div>';
                            echo '</p>';
                            echo '</div>';
                        }
                    }
                    else{
                        echo"<div id='aucun_resultat'>";
                        echo "<h3>Aucun resultat</h3>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>



        <div id="rechercher_salle">
            <div class="champ_rechercher">
                <form action="salles.php" method="GET">
                    <input type="text" name="barre_rechercher_salle" id="barre_rechercher_salle" placeholder="rechercher salle">
                    <button type="submit">
                        <img src="img/loupe_black.png" alt="loupe">
                    </button>
                </form>
            </div>

            <div class="resultat_recherche">
                <?php
                if (!isset($_GET['barre_rechercher_salle'])){
                    $preparation = $connexion->prepare('SELECT * FROM salle ORDER BY nom_salle');
                    $preparation->execute();
                    $tableaufetchsalle = $preparation->fetchAll();
                    foreach ($tableaufetchsalle as $colonne) {
                        echo '<div class="resultat_individuel">';
                        echo '<h3>';
                        echo htmlspecialchars($colonne['nom_salle']);
                        echo '</h3>';
                        echo '<p>';
                        echo 'Site : <span>' . htmlspecialchars($colonne['emplacement']) . '</span> <br>';
                        echo 'Etat : <span>' . htmlspecialchars($colonne['salle_disponible']) . '</span> <br>';
                        echo 'Nombre de places : <span>' . htmlspecialchars($colonne['nombre_places']) . '</span> <br>';
                        echo '<div id="bouton">';
                        echo '<a href="reservation_rapide.php?SalleNumero='. htmlspecialchars($colonne['id_salle']) .'"><button>Réserver</button></a>';
                        echo '</div>';
                        echo '</p>';
                        echo '</div>';
                    }
                }
                else{
                    $tableaufetchsalle = getSalles($connexion);
                    if ($tableaufetchsalle<>null){
                        foreach ($tableaufetchsalle as $colonne) {
                            echo '<div class="resultat_individuel">';
                            echo '<h3>';
                            echo htmlspecialchars($colonne['nom_salle']);
                            echo '</h3>';
                            echo 'Site : <span>' . htmlspecialchars($colonne['emplacement']) . '</span> <br>';
                            echo 'Etat : <span>' . htmlspecialchars($colonne['salle_disponible']) . '</span> <br>';
                            echo '<p>';
                            echo 'Nombre de places : <span>' . htmlspecialchars($colonne['nombre_places']) . '</span> <br>';
                            echo '<div id="bouton">';
                            echo '<a href="reservation_rapide.php?SalleNumero='. htmlspecialchars($colonne['id_salle']) .'"><button>Réserver</button></a>';
                            echo '</div>';
                            echo '</p>';
                            echo '</div>';
                        }
                    }
                    else{
                        echo"<div id='aucun_resultat'>";
                        echo "<h3>Aucun resultat</h3>";
                        echo "</div>";
                    }
                }
                ?>

            </div>
        </div>
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