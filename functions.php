<?php
function seConnecter(PDO &$connexion): bool
{
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];
    $motdepasse = hash('sha256',$motdepasse);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $preparation = $connexion->prepare("
            SELECT * 
            FROM utilisateur
            WHERE email_utilisateur=:email AND BINARY motdepasse_utilisateur=:motdepasse;
        ");
    $preparation->bindValue(':motdepasse', $motdepasse, PDO::PARAM_STR);
    $preparation->bindValue(':email', $email, PDO::PARAM_STR);
    $preparation->execute();
    $result = $preparation->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        session_start();
        //Pour avoir l'ID
        $requete = "SELECT id_utilisateur FROM utilisateur WHERE email_utilisateur='" . $email . "'";
        $preparation = $connexion->prepare($requete);
        $preparation->execute();
        $id_req = $preparation->fetch(PDO::FETCH_ASSOC);
        //
        $_SESSION['id_user'] = $id_req['id_utilisateur'];
        $_SESSION['nom_user'] = $result['nom_utilisateur'];
        $_SESSION['prenom_user'] = $result['prenom_utilisateur'];
        $_SESSION['email_user'] = $result['email_utilisateur'];
        $_SESSION['origine_user'] = $result['etablissement_utilisateur'];
        $_SESSION['connecter'] = true;
        return true;
    } else {
        return false;
    }
}
function sInscrire(PDO &$connexion): bool
{
    try {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $motdepasse = ($_POST['motdepasse'] == $_POST['motdepasseconfirmation']) ? $_POST['motdepasse'] : null;
        $motdepasse = hash('sha256',$motdepasse);
        $email = $_POST['email'];
        $origine = $_POST['choix_origine'];
        $nom = filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_var($prenom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $preparation = $connexion->prepare("
        INSERT INTO utilisateur
        (nom_utilisateur,prenom_utilisateur,motdepasse_utilisateur,email_utilisateur,etablissement_utilisateur)
        VALUES(:nom,:prenom,:motdepasse,:email,:origine)
        ");
        $preparation->bindValue(':nom', $nom, PDO::PARAM_STR);
        $preparation->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $preparation->bindValue(':motdepasse', $motdepasse, PDO::PARAM_STR);
        $preparation->bindValue(':email', $email, PDO::PARAM_STR);
        $preparation->bindValue(':origine', $origine, PDO::PARAM_STR);
        $preparation->execute();
        session_start();
        //Pour avoir l'ID
        $requete = "SELECT id_utilisateur FROM utilisateur WHERE email_utilisateur='" . $email . "'";
        $preparation = $connexion->prepare($requete);
        $preparation->execute();
        $id_req = $preparation->fetch(PDO::FETCH_ASSOC);
        //
        $_SESSION['id_user'] = $id_req['id_utilisateur'];
        $_SESSION['nom_user'] = $nom;
        $_SESSION['prenom_user'] = $prenom;
        $_SESSION['email_user'] = $email;
        $_SESSION['origine_user'] = $origine;
        $_SESSION['connecter'] = true;
        if(!envoyerEmailInscription())
        {
            echo "<script>alert('Email non envoyez')</script>";
        };
        return true;
    } catch (Exception $e) {
        if ($e->getCode() == 23000) {
            return false;
        } else {
            return false;
        }
    }
} //code...
function getSalles(PDO &$connexion)
{
    try {
        $entree = $_GET['barre_rechercher_salle'];
        $entree = filter_var($entree, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $requete = "SELECT * FROM salle WHERE nom_salle LIKE '%" . $entree . "%' ";
        $preparation = $connexion->prepare($requete);
        $preparation->execute();
        return $preparation->fetchAll();
    } catch (PDOException $e) {
        echo "Getsalle " . $e->getMessage();
        return false;
    }
}
function getSites(PDO &$connexion)
{
    try {
        $entree = $_GET['barre_rechercher_site'];
        $entree = filter_var($entree, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $requete = "SELECT *FROM salle WHERE emplacement LIKE '%" . $entree . "%' ";
        $preparation = $connexion->prepare($requete);
        $preparation->execute();
        return $preparation->fetchAll();
    } catch (Exception $e) {
        echo 'getSites ' . $e->getMessage() . $e->getLine();
        return false;
    }
}

function getReservationbySalles(PDO &$connexion)
{
    try {
        $entree = $_GET['barre_rechercher_salle'];
        $entree = filter_var($entree, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $requete = "SELECT salle.id_salle, reservation.id_reservation ,salle.nom_salle, salle.emplacement,reservation.jour_reserver,reservation.heure_debut,reservation.heure_fin
                        FROM reservation 
                        INNER JOIN salle ON salle.id_salle=reservation.id_salle
                        WHERE reservation.id_reservataire=" . $_SESSION['id_user'] . " AND salle.nom_salle LIKE '%" . $entree . "%'";
        $preparation = $connexion->prepare($requete);
        $preparation->execute();
        return $preparation->fetchAll();
    } catch (PDOException $e) {
        echo "getReservationbySalles " . $e->getMessage();
        return false;
    }
}
function getReservationbySites(PDO &$connexion)
{
    try {
        $entree = $_GET['barre_rechercher_site'];
        $entree = filter_var($entree, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $requete = "
                    SELECT salle.id_salle, reservation.id_reservation ,salle.nom_salle, salle.emplacement,reservation.jour_reserver,reservation.heure_debut,reservation.heure_fin
                    FROM reservation 
                    INNER JOIN salle ON salle.id_salle=reservation.id_salle
                    WHERE reservation.id_reservataire=" . $_SESSION['id_user'] . " AND salle.emplacement LIKE '%" . $entree . "%'";
        $preparation = $connexion->prepare($requete);
        $preparation->execute();
        return $preparation->fetchAll();
    } catch (Exception $e) {
        echo 'getReservationbySites ' . $e->getMessage() . $e->getLine();
        return false;
    }
}

function getReservation(PDO &$connexion)
{
    try {
        $requete = "
            SELECT 
            salle.id_salle,reservation.id_reservation,salle.nom_salle,salle.emplacement,reservation.jour_reserver,reservation.heure_debut,reservation.heure_fin,reservation.date_reservation
            FROM utilisateur
            INNER JOIN reservation ON reservation.id_reservataire = utilisateur.id_utilisateur
            INNER JOIN salle ON salle.id_salle = reservation.id_salle
            WHERE utilisateur.id_utilisateur ={$_SESSION['id_user']}";

        $preparation = $connexion->prepare($requete);
        // ORDER BY reservation.date_reservation DESC LIMIT 4
        $preparation->execute();
        return $preparation->fetchAll();
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
function reserverSalle(PDO &$connexion)
{
    try {
        $preparation_Verification_Aucun_Conflit = $connexion->prepare("
                SELECT * FROM reservation 
                WHERE 
                reservation.id_salle=:salle_id AND reservation.jour_reserver=:jr_reserver
                AND
                ((reservation.heure_debut<=:h_fin AND reservation.heure_fin>=:h_deb) OR(reservation.heure_debut>=:h_deb AND reservation.heure_debut<=:h_fin));
            ");
        $preparation_Verification_Aucun_Conflit->bindValue(':jr_reserver', $_POST['jour_reserver']);
        $preparation_Verification_Aucun_Conflit->bindValue(':h_deb', $_POST['heure_debut']);
        $preparation_Verification_Aucun_Conflit->bindValue(':h_fin', $_POST['heure_fin']);
        $preparation_Verification_Aucun_Conflit->bindValue(':salle_id', $_SESSION['id_SalleReservationEnCours'], PDO::PARAM_INT);
        $preparation_Verification_Aucun_Conflit->execute();
        $resultConflictuelle = $preparation_Verification_Aucun_Conflit->fetch(PDO::FETCH_ASSOC);
        if (!$resultConflictuelle) {
            echo "RECEIN : " . $resultConflictuelle;
            $preparation = $connexion->prepare("
                INSERT INTO `reservation` 
                (id_salle,id_reservataire,jour_reserver,heure_debut,heure_fin,date_reservation)
                VALUES ( :salle_id, :usr_id, :jr_reserver, :h_deb,:h_fin, :heureDeReservation)
                ");
            $preparation->bindValue(':salle_id', $_SESSION['id_SalleReservationEnCours'], PDO::PARAM_INT);
            $preparation->bindValue(':usr_id', $_SESSION['id_user'], PDO::PARAM_INT);
            $preparation->bindValue(':jr_reserver', $_POST['jour_reserver']);
            $preparation->bindValue(':h_deb', $_POST['heure_debut']);
            $preparation->bindValue(':h_fin', $_POST['heure_fin']);
            $timeStampActuelle = date('Y-m-d H:i:s', time());
            $preparation->bindValue(':heureDeReservation', $timeStampActuelle);
            $preparation->execute();
            return true;
        } else
            return false;
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false;
    }
}

function envoyerEmailInscription()
{
    $Destinataire = $_SESSION['email_user'];
    $Destinateur = 'newsletter_grp2@pang-smart.net';
    $subject = "Confirmation d'inscription sur la Plateforme de Gestion de Salle de l'UNB";
    $htmlContent = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nerko+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <style>
            *{
                font-family: roboto;
            }
            #central{
                background-color:rgb(240, 240, 240);
                width: 80%;
                height: 300px;
                padding: 20px 40px;
                border-radius: 20px;
                border : none;
                box-shadow: 0px 0px 2px black;
            }
            #central h1{
                font-family: sansita;
                font-size: 2.5rem;
                text-align: center;
                text-decoration: underline;
                color: #FFD700;
            }
            #central h2{
                font-family: nerko;
                font-size: 2rem;
                color :black;
            }
            #central p{
                font-size: 1.2rem;
                text-align: left;
                font-weight: bold;
                color :black;
            }
            #central span{
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div id="central">
            <h1>Email de confimation</h1>
            <p>
                <h2>Chèr(e) Mr/Mme ' . $_SESSION['nom_user'] . ' </h2>
                <p>
                Merci de vous etes inscrit sur la platforme de reservation de salle de l\'ESI.<br>
                Veuillez contacter les administrateurs en cas de soucis !
            </p>
        </div>
    </body>
    </html>
';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . $Destinateur . "\r\n";
    $headers .= 'Reply-To: ' . $Destinateur . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();

    // Envoi de l'email
    if (mail($Destinataire, $subject, $htmlContent, $headers)) {
        return true;
    } else {
        return false;
    }
}

function toheaven($something)
{
    echo '<pre>';
    print_r($something);
    echo '</pre>';
}
