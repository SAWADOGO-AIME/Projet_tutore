<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <input class="SearchInputSite" type="text" placeholder="Rechercher site">
        <button class="searchButtonSite"><img src="img/loupe.png" alt="Search"></button>
        <!-- Search Salle -->
        <p>👈🏿---------👉🏿</p>
        <input class="SearchInputSalle" type="text" placeholder="Rechercher salle">
        <button class="searchButtonSalle"><img src="img/loupe.png" alt="Search"></button>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nom de la Salle</th>
                    <th>Site</th>
                    <th>Date Debut</th>
                    <th>Date Fin</th>
                    <th>Libérer</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example row -->
                <tr>
                    <td>Bloc Pédagogique</td>
                    <td>Site du 22</td>
                    <td>31-12-2023</td>
                    <td>31-12-2024</td>
                    <td><a href="details.php">Libérer</a></td>
                    
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
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

