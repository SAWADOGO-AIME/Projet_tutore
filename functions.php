<?php
function seConnecter(PDO &$connexion) : bool{
        $email = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        $preparation = $connexion->prepare("
            SELECT * 
            FROM utilisateur
            WHERE email_utilisateur=:email AND BINARY motdepasse_utilisateur=:motdepasse;
        ");
        $preparation->bindValue(':motdepasse',$motdepasse,PDO::PARAM_STR);
        $preparation->bindValue(':email',$email,PDO::PARAM_STR);
        $preparation->execute();
        $result = $preparation->fetch(PDO::FETCH_ASSOC);

        if ($result){
            session_start();
            $_SESSION['nom_user'] = $result['nom_utilisateur'];
            $_SESSION['prenom_user'] = $result['prenom_utilisateur'];
            $_SESSION['email_user'] = $result['email_utilisateur'];
            $_SESSION['origine_user'] = $result['etablissement_utilisateur'];
            $_SESSION['connecter'] = true;
            return true;
        }else{
            return false;
        }
    }
    function sInscrire(PDO &$connexion) :bool{
        try{

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $motdepasse = ($_POST['motdepasse']==$_POST['motdepasseconfirmation']) ? $_POST['motdepasse'] : null;
        $email = $_POST['email'];
        $origine = $_POST['choix_origine'];
        $nom = filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_var($prenom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nom = filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $preparation = $connexion->prepare("
        INSERT INTO utilisateur
        (nom_utilisateur,prenom_utilisateur,motdepasse_utilisateur,email_utilisateur,etablissement_utilisateur)
        VALUES(:nom,:prenom,:motdepasse,:email,:origine)
        ");
        $preparation->bindValue(':nom',$nom,PDO::PARAM_STR);
        $preparation->bindValue(':prenom',$prenom,PDO::PARAM_STR);
        $preparation->bindValue(':motdepasse',$motdepasse,PDO::PARAM_STR);
        $preparation->bindValue(':email',$email,PDO::PARAM_STR);
        $preparation->bindValue(':origine',$origine,PDO::PARAM_STR);
        $preparation->execute();
        session_start();
        $_SESSION['nom_user'] = $nom;
        $_SESSION['prenom_user'] = $prenom;
        $_SESSION['email_user'] = $email;
        $_SESSION['origine_user'] = $origine;
        $_SESSION['connecter'] = true;
        return true;
    }
    catch(Exception $e){
        if ($e->getCode() == 23000){
            return false;
        }
        else{
            return false;
        }
    }
}//code...
    function getSalles(PDO & $connexion) {
        try {
            $entree = $_GET['barre_rechercher_salle'];
            $entree = filter_var($entree, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $requete = "SELECT * FROM salle WHERE nom_salle LIKE '%" .$entree. "%' ";
            $preparation = $connexion->prepare($requete);
            $preparation->execute();
            return $preparation->fetchAll();
        } catch ( PDOException $e ) {
            echo "Getsalle ".$e->getMessage();
            return false;
        }
    }
    function getSites(PDO & $connexion) {   
        try {
            $entree = $_GET['barre_rechercher_site'];
            $entree = filter_var($entree, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $requete = "SELECT *FROM salle WHERE emplacement LIKE '%" .$entree. "%' ";
            $preparation = $connexion->prepare($requete);
            $preparation->execute();
            return $preparation->fetchAll();
        } catch ( Exception $e ) {
            echo 'getSites '.$e->getMessage().$e->getLine();
            return false;
        }
    }

    function toheaven($something){
        echo '<pre>';
        print_r( $something );
        echo '</pre>';
    }
        ?>