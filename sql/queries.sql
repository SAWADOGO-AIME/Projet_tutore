CREATE DATABASE db_projet1;
USE db_projet1;

CREATE TABLE salle(
    id_salle INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_salle VARCHAR(40) NOT NULL UNIQUE,
    nombre_places INT NOT NULL,
    salle_disponible ENUM ('DISPONIBLE','INDISPONIBLE') NOT NULL,
    emplacement ENUM('SITE DU 22','INSSA','CENTRE DE CALCUL') NOT NULL
    );
INSERT INTO salle(nom_salle,nombre_places,salle_disponible,emplacement) VALUES('Amphi A',1000,'DISPONIBLE','INSSA');
INSERT INTO salle(nom_salle,nombre_places,salle_disponible,emplacement) VALUES('Amphi B',1000,'DISPONIBLE','INSSA');
INSERT INTO salle(nom_salle,nombre_places,salle_disponible,emplacement) VALUES('Amphi RTG',1000,'DISPONIBLE','INSSA');
INSERT INTO salle(nom_salle,nombre_places,salle_disponible,emplacement) VALUES('Bloc Pédagogique',150,'DISPONIBLE','SITE DU 22');
INSERT INTO salle(nom_salle,nombre_places,salle_disponible,emplacement) VALUES('Classe A',50,'DISPONIBLE','CENTRE DE CALCUL');
INSERT INTO salle(nom_salle,nombre_places,salle_disponible,emplacement) VALUES('Classe B',50,'DISPONIBLE','CENTRE DE CALCUL');
INSERT INTO salle(nom_salle,nombre_places,salle_disponible,emplacement) VALUES('Classe D',50,'DISPONIBLE','CENTRE DE CALCUL');

CREATE TABLE utilisateur(
    id_utilisateur INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(30) NOT NULL ,
    prenom_utilisateur VARCHAR(50) NOT NULL ,
    motdepasse_utilisateur VARCHAR(25) NOT NULL ,
    email_utilisateur VARCHAR(50) UNIQUE NOT NULL,
    etablissement_utilisateur ENUM('SITE DU 22','INSSA','CENTRE DE CALCUL') NOT NULL
    );

INSERT INTO utilisateur(nom_utilisateur,prenom_utilisateur,motdepasse_utilisateur,email_utilisateur,etablissement_utilisateur)
        VALUES ('ange','root','root','Diassomarion@gmail.com','SITE DU 22');


CREATE TABLE reservation (
    id_reservation INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_salle INT NOT NULL ,
    id_reservataire INT NOT NULL,
    jour_reserver DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    date_reservation TIMESTAMP,
    CONSTRAINT FOREIGN KEY (id_salle) REFERENCES salle(id_salle),
    CONSTRAINT FOREIGN KEY (id_reservataire) REFERENCES utilisateur(id_utilisateur)
    );
INSERT INTO `reservation` (`id_reservation`, `id_salle`, `id_reservataire`, `jour_reserver`, `heure_debut`, `heure_fin`, `date_reservation`) VALUES (NULL, '2', '1', '2024-09-05', '22:39:00', '23:47:15', NULL)

                INSERT INTO `reservation` 
                (`id_reservation`, `id_salle`, `id_reservataire`, `jour_reserver`, `heure_debut`, `heure_fin`, `date_reservation`)
                VALUES (NULL, '2', '1', '2024-09-05', '22:39:00', '23:47:15', NULL)


SELECT * 
FROM reservation
LEFT JOIN utilisateur ON id_reservataire=utilisateur.id_utilisateur

SELECT 
	salle.nom_salle,salle.emplacement,reservation.jour_reserver,reservation.heure_debut,reservation.heure_fin
FROM
    reservation
LEFT JOIN utilisateur ON reservation.id_reservataire =utilisateur.id_utilisateur
LEFT JOIN salle ON salle.id_salle=reservation.id_salle;


SELECT 
	salle.id_salle,reservation.id_reservation,salle.nom_salle,salle.emplacement,reservation.jour_reserver,reservation.heure_debut,reservation.heure_fin
FROM
    reservation
LEFT JOIN utilisateur ON reservation.id_reservataire =utilisateur.id_utilisateur
LEFT JOIN salle ON salle.id_salle=reservation.id_salle;

#Ancien
CREATE TABLE reservation (
    id_reservation INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_salle INT NOT NULL ,
    id_reservataire INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    date_reservation TIMESTAMP,
    CONSTRAINT FOREIGN KEY (id_salle) REFERENCES salle(id_salle),
    CONSTRAINT FOREIGN KEY (id_reservataire) REFERENCES utilisateur(id_utilisateur)
    );

SELECT 
            salle.id_salle,reservation.id_reservation,salle.nom_salle,salle.emplacement,reservation.jour_reserver,reservation.heure_debut,reservation.heure_fin, reservation.date_reservation 
            FROM reservation 
            LEFT JOIN utilisateur ON reservation.id_reservataire=1
            LEFT JOIN salle ON salle.id_salle=reservation.id_salle  
ORDER BY `reservation`.`date_reservation` DESC

SELECT 
    salle.id_salle,
    reservation.id_reservation,
    salle.nom_salle,
    salle.emplacement,
    reservation.jour_reserver,
    reservation.heure_debut,
    reservation.heure_fin,
    reservation.date_reservation
FROM utilisateur
LEFT JOIN reservation ON reservation.id_reservataire = utilisateur.id_utilisateur
LEFT JOIN salle ON salle.id_salle = reservation.id_salle
WHERE utilisateur.id_utilisateur = 2
ORDER BY reservation.date_reservation DESC;
