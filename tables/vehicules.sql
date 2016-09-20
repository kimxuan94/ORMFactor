CREATE TABLE IF NOT EXISTS `vehicules` (
`id_immatveh` bigint(9) NOT NULL,
`num_contrat` int(3) NOT NULL,
`nom_loueur` varchar(45) NOT NULL,
`val_achat` int NOT NULL,
`premiere_circulation` date NOT NULL,
`entree_parc` date NOT NULL,
`sortie_parc` date NOT NULL,
`categorie_vehicule` enum('VP','VU','VI') NOT NULL,
`marque` enum('Audi','BMW','Autre') NOT NULL,
`modele` varchar(45) NOT NULL,
`version` varchar(45) NOT NULL,
`numero_chassis` varchar(45) NOT NULL,
`boite_vitesse` enum('Automatique','Manuelle') NOT NULL,
`puissance_fiscale` varchar(45) NOT NULL,
`nb_km` int NOT NULL,
`nb_portes` int NOT NULL,
`nb_places` int NOT NULL,
`reservoir` float NOT NULL,
`carburant` enum('Diesel','Essence','Autre') NOT NULL,
`conso_mixte` float NOT NULL,
`qte_co2` float NOT NULL,
`type_detention` enum('Achat','LCD','LLD') NOT NULL,
`loyer_financier` float NOT NULL,
`loyer_p_financiere` float NOT NULL,
`loyer_pneu` float NOT NULL,
`loyer_autre` float NOT NULL,
`loyer_total` float NOT NULL,
`commentaire` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `vehicules`
  ADD PRIMARY KEY(`id_immatveh`);
