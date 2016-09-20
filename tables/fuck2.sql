CREATE TABLE Contrats(
  no_contrat INT(5) UNSIGNED,
  matricule INT(5) UNSIGNED ZEROFILL,
  immatricule INT(9) UNSIGNED,
  l_collaborateurs VARCHAR(30) NOT NULL,
  l_vehicules VARCHAR(30) NOT NULL,
  debut_contrat DATE NOT NULL,
  fin_contrat DATE NOT NULL,
  val_franchise FLOAT NOT NULL,
  nb_accidents INT(2) NOT NULL,
  prem_franchise_accident FLOAT NOT NULL,
  deux_franchise_accident FLOAT NOT NULL,
  troi_franchise_accident FLOAT NOT NULL,
  quat_franchise_accident FLOAT NOT NULL,
  commentaires TEXT,
  PRIMARY KEY(no_contrat)
)
ENGINE=InnoDB;

CREATE TABLE Collaborateurs(
  id_matrh INT(5) UNSIGNED ZEROFILL,
  nom VARCHAR(30) NOT NULL,
  prenom VARCHAR(30) NOT NULL,
  adresse TEXT,
  code_postal INT(5) NOT NULL,
  ville VARCHAR(30) NOT NULL,
  profession ENUM('AR','ARS', 'APM') NOT NULL,
  justificatif BLOB,
  avantage_nature FLOAT NOT NULL,
  date_entree DATE NOT NULL,
  date_sortie DATE NOT NULL,
  commentaires TEXT,
  PRIMARY KEY(id_matrh)
)
ENGINE=InnoDB;

INSERT INTO Collaborateurs(id_matrh,nom,prenom,adresse,code_postal,ville,profession,justificatif,avantage_nature,date_entree,date_sortie,commentaires)
  VALUES
  (01234,'Mimi','Mati','7 av Rochefort',75002,'Paris','AR','',25000,'2013-01-01','2016-30-12','Ange Gardien de la société'),
  (12345,'Cassali','Pedro','7 rue Jaures',75018,'Paris','ARS','',25000,'2011-01-01','2014-30-12','RP de la société'),
  (23456,'Joao','José','7 bis Beirao',09876,'Portugal','APM','',25000,'2012-01-01','2015-30-12','Footeux de la société'),
  (34567,'Rados','Sam','7 av Moulino',75012,'Paris','AR','',25000,'2013-12-01','2016-30-16','Comique de la société');

  -- Remplissage de espece_id
  -- UPDATE Contrats SET matricule_id = 1 WHERE matricule = 'chien';
  -- UPDATE Contrats SET matricule_id = 2 WHERE matricule = 'chat';
  -- UPDATE Contrats SET matricule_id = 3 WHERE matricuke = 'tortue';
  -- UPDATE Contrats SET matricule_id = 4 WHERE matricuke = 'perroquet';

  -- Ajout de la clé étrangère
  ALTER TABLE Contrats
  ADD CONSTRAINT fk_matricule_id FOREIGN KEY (matricule_id) REFERENCES Collaborateurs(id_matrh);

  ALTER TABLE Contrats
  ADD CONSTRAINT fk_immatricule_id FOREIGN KEY (immatricule_id) REFERENCES Vehicules(id_immatveh);

  ALTER TABLE Contrats
  ADD CONSTRAINT fk_immatricule_id FOREIGN KEY (immatricule_id) REFERENCES Vehicules(id_immatveh);
--Jointure--
SELECT id_matrh AS id_matricule2
FROM Collaborateurs
LEFT JOIN Contrats ON Collaborateurs.id_matrh = Contrats.no_contrat

--1ère jointure: on veut récupérer l'id_matrh de Collaborateurs dans le champs matricule
SELECT id_matrh AS id_matricule2
FROM Collaborateurs
LEFT JOIN Contrats ON Contrats.matricule_id = Collaborateurs.id_matrh

SELECT nom + prenom AS liste_collaborateurs
FROM Collaborateurs
LEFT JOIN Contrats ON Contrats.no_contrat = Collaborateurs.id_matrh

--2ème jointure: on veut récupérer le nom et prénom de Collaborateur dans le champs l_collaborateurs--
SELECT nom, prenom
FROM Collaborateurs
LEFT JOIN Contrats ON Contrats.no_contrat = Collaborateurs.id_matrh

SELECT nom, prenom
FROM Collaborateurs
LEFT JOIN Contrats ON Contrats.l_collaborateurs = Collaborateurs.id_matrh

ALTER TABLE Contrats
ADD CONSTRAINT fk_matricule_id FOREIGN KEY (l_collaborateurs) REFERENCES Collaborateurs(nom);
--!-------------------------!--
CREATE TABLE Vehicules(
  id_immatveh INT(9) UNSIGNED,
  num_contrat INT(3) NOT NULL,
  nom_loueur ENUM('LEASEPLAN','ALPHABET','AUTRE') NOT NULL,
  val_achat FLOAT NOT NULL,
  prem_circulation DATE NOT NULL,
  entree_parc DATE NOT NULL,
  sortie_parc DATE NOT NULL,
  cat_vehicule ENUM('VP','VU','VI') NOT NULL,
  marque ENUM('AUDI','BMW','AUTRE') NOT NULL,
  modele VARCHAR(30) NOT NULL,
  version VARCHAR(30) NOT NULL,
  no_chassis VARCHAR(30) NOT NULL,
  boite_vitesse ENUM('Automatique','Manuelle') NOT NULL,
  puissance_fiscale VARCHAR(30) NOT NULL,
  nb_km INT NOT NULL,
  nb_portes INT NOT NULL,
  nb_places INT NOT NULL,
  reservoir FLOAT NOT NULL,
  carburant ENUM('DIESEL','ESSENCE','AUTRE') NOT NULL,
  conso_mixte FLOAT NOT NULL,
  qte_co2 FLOAT NOT NULL,
  detention ENUM('Achat','LCD','LLD') NOT NULL,
  loyer_financier FLOAT NOT NULL,
  loyer_p_financiere FLOAT NOT NULL,
  loyer_pneu FLOAT NOT NULL,
  loyer_autre FLOAT NOT NULL,
  loyer_total FLOAT NOT NULL,
  commentaires TEXT,
  PRIMARY KEY(id_immatveh)
)
ENGINE=InnoDB;

CREATE TABLE Frais (
  poste_frais INT(11) NOT NULL,
  reparation FLOAT NOT NULL,
  gardiennage FLOAT NOT NULL,
  remplacement FLOAT NOT NULL,
  remise_neuf FLOAT NOT NULL,
  supp_pneu FLOAT NOT NULL,
  date_facturation timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  commentaire TEXT NOT NULL
) ENGINE=InnoDB;

--
-- Contenu de la table `frais`
--

INSERT INTO `frais` (`poste_frais`, `reparation`, `gardiennage`, `remplacement`, `remise_neuf`, `supp_pneu`, `date_facturation`, `commentaire`) VALUES
(2, 500, 350, 150, 100, 200, '2016-07-17 22:00:00', 'Deuxième entrée'),
(3, 500, 300, 300, 200, 90, '2016-07-17 22:00:00', 'Troisième entrée !'),
(4, 500, 300, 280, 800, 0, '0000-00-00 00:00:00', 'Un dernière pour la route x)'),
(5, 700, 200, 300, 0, 90, '2016-07-17 22:00:00', 'Dernier test, on espere que ça marche :p'),
(6, 100, 200, 2000, 100, 0, '2016-07-18 22:00:00', 'blbalbalaba');


CREATE TABLE Fichiers (
  id_fichier INT(2) AUTO_INCREMENT NOT NULL,
  Nom VARCHAR(30) NOT NULL,
  Type DEFAULT NULL,
  Date_upload timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Data LONGBLOB,
  PRIMARY KEY(id_ficher)
) ENGINE=In


--1ère règle pour faire une liaison fk->pk toujours conserver les types de la clé de référence
--2eme règle une table peut avoir plusieurs clés étrangères --

--LIAISON COLLABORATEURS->CONTRATS
--1ère jointure: on veut récupérer l'id_matrh de Collaborateurs dans le champs matricule
--LIAISON COLLABORATEURS->CONTRATS
--2ème jointure: on veut récupérer le nom et prénom de Collaborateur dans le champs l_collaborateurs--
--LIAISON VEHICULES->CONTRATS
--1ère jointure: on veut récupérer l'id_immatveh de Collaborateurs dans le champs immatricule
--LIAISON VEHICULES->CONTRATS
--3ème jointure: on veut récupérer la marque et modèle de Vehicules dans le champs l_vehicules--
