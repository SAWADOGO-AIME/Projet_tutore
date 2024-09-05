<?php
        session_start();
        require_once 'connexion_base_Donnee.php';
        $preparation = $connexion->prepare("
        DELETE FROM `reservation`
        WHERE reservation.id_reservation =:rsv_id  AND reservation.id_reservataire=:usr_id");
        $preparation->bindValue(':rsv_id',$_GET['Salle_a_Liberer']);
        $preparation->bindValue(':usr_id',$_SESSION['id_user']);
        if ($preparation->execute()){
            header("Location:{$_SERVER['HTTP_REFERER']}");
        }
        else{
            echo '<style>';
            echo "alert('ECHEC');";
            echo '</style>';
        }
?>