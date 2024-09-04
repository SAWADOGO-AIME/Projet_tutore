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
    <link rel="stylesheet" href="details.css">
</head>

<body>
    <!-- Header -->
    <?php
    require_once 'header.php';
    ?>
    <div id="div_central">
        <h2>Détails sur la salle :     
            <!-- <?= htmlspecialchars($row['nom_salle']) ?> -->
        </h2>
        <div div="bloc_detail">
            <div id="image">
                <img src="img/PhotodesalleMachine.png" alt="Salle machine">
            </div>
            <p><strong>Nom:</strong> <span class="highlight">Bloc pédagogique</span></p>
            <p><strong>Site:</strong> <span class="highlight">Nasso</span></p>
            <p><strong>Capacité maximale:</strong> <span class="highlight">25</span></p>
            <p><strong>Équipement :</strong> <span class="highlight">Projecteur, micro</span></p>
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
                    events: [{
                        title: 'Birthday Party',
                        start: '2024-08-30T07:00:00',
                        end: '2024-08-30T10:00:00',
                    }, ]
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