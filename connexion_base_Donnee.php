<?php
    $servername = 'mysql:host=localhost;dbname=db_projet1';
    $username = 'root';
    $password = '';
    try {
        $connexion = new PDO($servername, $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Erreur : ". $e->getMessage();
        }
?>