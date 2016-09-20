CREATE TABLE `contrats` (
  `no_contrat` int(11) NOT NULL,
  `list_collab` varchar(255) DEFAULT NULL,
  `list_vehicules` enum('VP','VU','VI') DEFAULT NULL,
  `debut_contrat` date NOT NULL,
  `fin_contrat` date NOT NULL,
  `val_franchise` float(7,4) DEFAULT NULL,
  `nb_accidents` int(11) DEFAULT NULL,
  `fran_accident1` float(7,4) DEFAULT NULL,
  `fran_accident2` float(7,4) DEFAULT NULL,
  `fran_accident3` float(7,4) DEFAULT NULL,
  `fran_accident4` float(7,4) DEFAULT NULL,
  `Fk_ImmatVEH` int(11) DEFAULT NULL,
  `FK_matRH` int(5) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contrats`
--

INSERT INTO `contrats` (`no_contrat`, `list_collab`, `list_vehicules`, `debut_contrat`, `fin_contrat`, `val_franchise`, `nb_accidents`, `fran_accident1`, `fran_accident2`, `fran_accident3`, `fran_accident4`, `Fk_ImmatVEH`, `FK_matRH`) VALUES
(1, NULL, NULL, '2016-05-01', '2016-05-31', 200.0000, 0, 0.0000, 0.0000, 0.0000, 0.0000, 0, 0),
(2, NULL, NULL, '2016-05-01', '2016-05-31', 200.0000, 0, 0.0000, 0.0000, 0.0000, 0.0000, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`no_contrat`),
  ADD KEY `Pk_ImmatVEH` (`Fk_ImmatVEH`),
  ADD KEY `Pk_matRH` (`FK_matRH`);
