<?php
    if(isset($_GET['SalleNumero']))
    {
        try{
            $id = $_GET['SalleNumero'];
            require_once 'connexion_base_Donnee.php';
            require_once 'functions.php';
            $preparation = $connexion->prepare('SELECT * FROM salle WHERE id_salle=:id');
            $preparation->bindValue(':id',$id,PDO::PARAM_INT);
            $preparation->execute();
            $resultat = $preparation->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            echo 'Erreur : '. $e->getMessage();
        }
    }   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/details.css">
</head>

<body>
    <!-- Header -->
    <?php
    require_once 'header.php';
    ?>
    <div id="div_central">
        <h2>Détails sur la salle :     
            <span><?= htmlspecialchars($resultat['nom_salle'])?></span>
        </h2>
        <div id="bloc_detail">
            <div>
                <p><strong>Nom:</strong> <span class="highlight"> <?= htmlspecialchars($resultat['nom_salle'])?></span></p>
                <p><strong>Site:</strong> <span class="highlight"> <?= htmlspecialchars($resultat['emplacement'])?></span></p>
                <p><strong>Etat:</strong> <span class="highlight"> <?= htmlspecialchars($resultat['salle_disponible'])?></span></p>
                <p><strong>Capacité maximale:</strong> <span class="highlight"> <?= htmlspecialchars($resultat['nombre_places'])?></span></p>
                <p><strong>Équipement:</strong> <span class="highlight"> Projecteur, micro</span></p>
            </div>
            <div id="image">
                <img src="img/PhotodesalleMachine.png" alt="Salle machine">
            </div>
        </div>
    </div>
        <div class="calendar-section">
            <h2>Calendrier d'occupation</h2>
            <div id="calendar"></div>
            <div class="reserve-button">
                <button>📅 Reserver</button>
            </div>
        </div>
        <!-- FullCalendar CSS -->
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

        <!-- FullCalendar JS -->

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
        <?php
        if(isset($_GET['SalleNumero']))
        {
            try{
                $preparation = $connexion->prepare("
                SELECT reservation.jour_reserver, reservation.heure_debut, reservation.heure_fin
                FROM reservation
                WHERE reservation.id_salle=:id_salle;
                ");
                $preparation->bindValue(':id_salle',$_GET['SalleNumero'],PDO::PARAM_INT);
                $preparation->execute();
                $resultatPOURcal = $preparation->fetchall(PDO::FETCH_ASSOC);
                toheaven($resultatPOURcal);
                $debut = $resultatPOURcal[0]['jour_reserver'] .'T'.$resultatPOURcal[0]['heure_debut'];
                $fin = $resultatPOURcal[0]['jour_reserver'] .'T'.$resultatPOURcal[0]['heure_debut'];
                echo $debut .' | '. $fin;
            }catch(Exception $e){
                echo 'Erreur : '. $e->getMessage();
            }
        }
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    initialDate: '2024-08-30', // The date to display when the calendar is first rendered
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    selectable: true,
                    events: [
                        <?php
                        foreach ($resultatPOURcal as $colonne)
                        {
                            echo "{";
                            echo "title: 'Résever',";
                            echo "start : '". htmlspecialchars($colonne['jour_reserver']) ."T". htmlspecialchars($colonne['heure_debut']) ."',";
                            echo "end : '". htmlspecialchars($colonne['jour_reserver']) ."T". htmlspecialchars($colonne['heure_fin']) ."',";
                            echo "},";
                        } 
                            ?>
                    ]
                });

                calendar.render();
            });
        </script>



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