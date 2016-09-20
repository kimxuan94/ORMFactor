--EXERCICE--

--TABLE FAMILLE--
CREATE TABLE Famille(
  id SMALLINT AUTO_INCREMENT,
  relation VARCHAR(40) NOT NULL,
  sexe CHAR(1)
  date_naissance DATETIME NOT NULL,
  nom VARCHAR(30),
  commentaires TEXT,
  PRIMARY KEY(id)
)
ENGINE=InnoDB;



--TABLE RELATION--
CREATE TABLE Relation(
  id SMALLINT UNSIGNED AUTO_INCREMENT,
  nom VARCHAR(40) NOT NULL,
  prenom VARCHAR(30) NOT NULL,
  description TEXT,
  PRIMARY KEY(id)
)
ENGINE=InnoDB;

INSERT INTO Relation (nom, genre, description) VALUES
('Soeur', 'fille', 'Personne qui donne des conseils'),
('Ami', 'garçon ou fille', 'Personne qui est comme une deuxième famille'),
('Mère', 'file', 'Personne qui donne de l\'amour et fait des gateaux'),
('Père', 'garçon', 'Personne qui protège sa famille');

ALTER TABLE Famille ADD COLUMN relation_id
SMALLINT UNSIGNED;

-- Remplissage de espece_id
UPDATE Famille SET relation_id = 1 WHERE relation = 'soeur';
UPDATE Famille SET relation_id = 2 WHERE relation = 'ami';
UPDATE Famille SET relation_id = 3 WHERE relation = 'mère';
UPDATE Famille SET relation_id = 4 WHERE relation = 'père';

-- Suppression de la colonne espece
ALTER TABLE Famille DROP COLUMN relation;

-- Ajout de la clé étrangère

ALTER TABLE Famille
ADD CONSTRAINT fk_relation_id FOREIGN KEY (relation_id) REFERENCES Relation(id);

INSERT INTO Famille (sexe, date_naissance, nom, commentaires)
VALUES ('F', 5, '2009-02-15 12:45:00', 'justine', 'soeur qui fait de très bon gateaux');
