<?php
    session_start();
    if(isset($_GET['SalleNumero']))
    {
        if (!isset($_SESSION['connecter']))
        {
            header('Location: connexion.php');
            exit;
        }
        $id = $_GET['SalleNumero'];
        require_once 'connexion_base_Donnee.php';
        $preparation = $connexion->prepare('SELECT * FROM salle WHERE id_salle=:id');
        $preparation->bindValue(':id',$id,PDO::PARAM_INT);
        $preparation->execute();
        $resultat = $preparation->fetch(PDO::FETCH_ASSOC);
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
                    <p>Faites une demande de réservation et recevez confirmation par mail...</p>
                    <form>
                        <label for="room">Sélectionnez la salle</label>
                        <select id="room" name="room">
                            <option value="">Sélectionnez</option>
                            <!-- Add more room options here -->
                        </select>
        
                        <div class="date-time">
                            <div class="date-input">
                                <label for="start">H Début</label>
                                <input type="date" id="start" name="start">
                            </div>
                            <div class="date-input">
                                <label for="end">H Fin</label>
                                <input type="date" id="end" name="end">
                            </div>
                        </div>
                        <div class="date-time">
                            <div class="date-input">
                                <label for="start">H Début</label>
                                <input type="time" id="start" name="start">
                            </div>
                            <div class="date-input">
                                <label for="end">H Fin</label>
                                <input type="time" id="end" name="end">
                            </div>
                        </div>
        
                        <label for="participants">Nombre de participants</label>
                        <select id="participants" name="participants">
                            <option value="50">50</option>
                            <option value="75">75</option>
                            <option value="100">100</option>
                            <option value="125">125</option>
                            <option value="200">200</option>
                            <option value="400">400</option>
                            <option value="700">700</option>
                            <option value="1000">1000</option>
                            <option value="1500">1500</option>
                            <option value="2000">2000</option>
                            <option value="2500">2500</option>
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