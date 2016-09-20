CREATE TABLE `frais` (
  `poste_frais` int(11) NOT NULL,
  `reparation` float NOT NULL,
  `gardiennage` float NOT NULL,
  `remplacement` float NOT NULL,
  `remise_neuf` float NOT NULL,
  `supp_pneu` float NOT NULL,
  `date_facturation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `commentaire` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frais`
--

INSERT INTO `frais` (`poste_frais`, `reparation`, `gardiennage`, `remplacement`, `remise_neuf`, `supp_pneu`, `date_facturation`, `commentaire`) VALUES
(1, 1200, 1200, 1200, 1200, 500, '2016-07-17 22:00:00', 'Nouveau frais'),
(2, 500, 350, 150, 100, 200, '2016-07-17 22:00:00', 'Deuxième entrée'),
(3, 500, 300, 300, 200, 90, '2016-07-17 22:00:00', 'Troisième entrée !');

--
-- Indexes for dumped tables
--

ALTER TABLE `frais`
  ADD PRIMARY KEY(`poste_frais`);
