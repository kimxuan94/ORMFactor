--EXERCICE--

--TABLE CONTRATS--
CREATE TABLE Contracts(
  no_contrat INT(5) UNSIGNED,
  matricule INT(5) UNSIGNED ZEROFILL,
  commentaires TEXT,
  PRIMARY KEY(no_contrat)
)
ENGINE=InnoDB;

--TABLE COLLABS--
CREATE TABLE Collabs(
  id_matrh INT(5) UNSIGNED ZEROFILL,
  nom VARCHAR(40) NOT NULL,
  prenom VARCHAR(40) NOT NULL,
  commentaires TEXT,
  PRIMARY KEY(id_matrh)
)
ENGINE=InnoDB;

INSERT INTO Collabs (id_matrh, nom, prenom, commentaires) VALUES
  (01234,'Mimi','Mati','Ange Gardien de la société'),
  (12345,'Castaldi','Benjamin','Présentateur tv'),
  (23456,'Joao','José','Joeur de foot');

  SELECT id_matrh AS matriculeRH
  FROM Collabs
  LEFT JOIN Contracts ON Collabs.id_matrh = Contracts.no_contrat
