<?php
    session_start();
    require_once 'functions.php';
    if ($_SERVER['REQUEST_METHOD'] =='GET')
    {
        unset($_SESSION['id_SalleReservationEnCours']);
    }
    if($_SERVER['REQUEST_METHOD'] =='POST' || $_SERVER['REQUEST_METHOD'] =='GET'){
        $reservationEffectuer = false;
        require_once 'connexion_base_Donnee.php';
        if(isset($_GET['SalleNumero']) || isset($_SESSION['id_SalleReservationEnCours']))
        {   
            if (!isset($_SESSION['connecter']))
            {
                header('Location: connexion.php');
                exit;
            }

            if(!isset($_SESSION['id_SalleReservationEnCours']))
                $_SESSION['id_SalleReservationEnCours']= $_GET['SalleNumero'];
        
        $id = $_SESSION['id_SalleReservationEnCours'];
        $preparation = $connexion->prepare('SELECT * FROM salle WHERE id_salle=:id');
        $preparation->bindValue(':id',$id,PDO::PARAM_INT);
        $preparation->execute();
        $resultatSalleConcerne = $preparation->fetch(PDO::FETCH_ASSOC);
        
        }
        if($_SERVER['REQUEST_METHOD'] =='POST')
        {
            if(reserverSalle($connexion)){
                $reservationEffectuer = true;
            }
        }
}
    else{
        header('Location:salles.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Meta Tags -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réservation rapide</title>
        <link rel="stylesheet" href="style/header.css">
        <link rel="stylesheet" href="style/footer.css">
        <link rel="stylesheet" href="style/reservation_rapide.css">
    </head>
    
    <body>
            <!-- Header -->
            <?php
                require_once 'header.php';
            ?>
            <div class="container">
                <img src="img/animal.png" alt="Background Image" class="background-image">
                <div class="reservation-form">
                    <h2>Fiche de réservation</h2>
                    <h3>
                        Salle : <?=htmlspecialchars($resultatSalleConcerne['nom_salle'])?> <br>
                        Site : <?=htmlspecialchars($resultatSalleConcerne['emplacement'])?>
                    </h3>
                    <p>Faites une demande de réservation et recevez confirmation par mail...</p>
                    <form method="post" action="reservation_rapide.php">
                        <div class="champ_date_temps">
                            <div class="entree_date_heure">
                                <label for="jour_reserver">Jour de la réservation</label>
                                <input type="date" id="jour_reserver" name="jour_reserver" required>
                            </div>
                        </div>
                        <div class="champ_date_temps">
                            <div class="entree_date_heure">
                                <label for="heure_debut">Heure Début</label>
                                <input type="time" id="heure_debut" name="heure_debut" required>
                            </div>
                            <div class="entree_date_heure">
                                <label for="heure_fin">Heure Fin</label>
                                <input type="time" id="heure_fin" name="heure_fin" required>
                            </div>
                        </div>
        
                        <label for="nbr_participants">Nombre de participants</label>
                        <select id="nbr_participants" name="nbr_participants" required>
                            <?php
                                $x = 25;
                                $i = 50;
                                for ($i; $i<=$resultatSalleConcerne['nombre_places']; $i+=$x){
                                    echo '<option value=" '. $i .'"> '. $i .'</option>';
                                    if ($i == 100)
                                    $x = 50;
                                    if ($i == 200)
                                    $x = 300;
                                    if(($i+$x)> $resultatSalleConcerne['nombre_places'] && $i<>50){
                                        echo '<option value=" '. $resultatSalleConcerne['nombre_places'] .'"> '. $resultatSalleConcerne['nombre_places'] .'</option>';
                                    }

                                }
                            ?>
                        </select>
                            <button type="submit">Valider</button>
                    </form>
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