CREATE TABLE IF NOT EXISTS `collaborateurs` (
`id_matrh` int(5) NOT NULL,
`nom` varchar(45) NOT NULL,
`prenom` varchar(45) NOT NULL,
`adresse` text NOT NULL,
`codepostal` int(5) NOT NULL,
`ville` varchar(45) NOT NULL,
`profession` enum('AR','ARS','APM') NOT NULL,
`justificatif` blob,
`avantage_nature` float NOT NULL,
`debut_contrat` date NOT NULL,
`fin_contrat` date NOT NULL,
`commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `collaborateurs`
  ADD PRIMARY KEY(`id_matrh`);
