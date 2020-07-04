-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 05 juil. 2020 à 01:20
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `ID_MEMBRE` int(11) NOT NULL,
  `BADGE` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `ID_CLASSE` int(11) NOT NULL,
  `NOM_CLASSE` varchar(254) DEFAULT NULL,
  `DESC_CLASSE` varchar(254) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `SEMESTRE` varchar(254) DEFAULT NULL,
  `ID_MEMBRE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`ID_CLASSE`, `NOM_CLASSE`, `DESC_CLASSE`, `code`, `SEMESTRE`, `ID_MEMBRE`) VALUES
(9, 'jj', 'ljl ytrtx', 'gg', '1', 48),
(10, 'name', 'rrrr', 'pw', 'S3 - S4', 48),
(12, 'testclasse', 'rrrr', 'pw', 'S3 - S4', 48),
(42, 'hey there', 'this is desc', 'pw', 'S3 - S4', 55),
(43, 'git 101', 'learn how to use git', 'pw', 'S5 - S6', 54),
(44, 'classe name 2', 'description for classe', 'jj', 'S3 - S4', 57),
(46, 'class added', 'vv', 'vv', 'S1 - S2', 57);

-- --------------------------------------------------------

--
-- Structure de la table `classes_joined`
--

CREATE TABLE `classes_joined` (
  `ID_MEMBRE` int(11) NOT NULL,
  `ID_CLASSE1` int(11) DEFAULT NULL,
  `ID_CLASSE2` int(11) DEFAULT NULL,
  `ID_CLASSE3` int(11) DEFAULT NULL,
  `ID_CLASSE4` int(11) DEFAULT NULL,
  `ID_CLASSE5` int(11) DEFAULT NULL,
  `ID_CLASSE6` int(11) DEFAULT NULL,
  `ID_CLASSE7` int(11) DEFAULT NULL,
  `ID_CLASSE8` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classes_joined`
--

INSERT INTO `classes_joined` (`ID_MEMBRE`, `ID_CLASSE1`, `ID_CLASSE2`, `ID_CLASSE3`, `ID_CLASSE4`, `ID_CLASSE5`, `ID_CLASSE6`, `ID_CLASSE7`, `ID_CLASSE8`) VALUES
(57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `classes_made`
--

CREATE TABLE `classes_made` (
  `ID_MEMBRE` int(11) NOT NULL,
  `ID_CLASSE0` int(11) DEFAULT NULL,
  `ID_CLASSE1` int(11) DEFAULT NULL,
  `ID_CLASSE2` int(11) DEFAULT NULL,
  `ID_CLASSE3` int(11) DEFAULT NULL,
  `ID_CLASSE4` int(11) DEFAULT NULL,
  `ID_CLASSE5` int(11) DEFAULT NULL,
  `ID_CLASSE6` int(11) DEFAULT NULL,
  `ID_CLASSE7` int(11) DEFAULT NULL,
  `ID_CLASSE8` int(11) DEFAULT NULL,
  `ID_CLASSE9` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classes_made`
--

INSERT INTO `classes_made` (`ID_MEMBRE`, `ID_CLASSE0`, `ID_CLASSE1`, `ID_CLASSE2`, `ID_CLASSE3`, `ID_CLASSE4`, `ID_CLASSE5`, `ID_CLASSE6`, `ID_CLASSE7`, `ID_CLASSE8`, `ID_CLASSE9`) VALUES
(54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `ID_COMM` int(11) NOT NULL,
  `CONTENU_COMM` varchar(254) DEFAULT NULL,
  `DATE_COMM` datetime DEFAULT NULL,
  `ID_MEMBRE` int(11) DEFAULT NULL,
  `ID_PUB` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `ID_MEMBRE` int(11) NOT NULL,
  `CNE` varchar(254) DEFAULT NULL,
  `APOGEE` varchar(8) DEFAULT NULL,
  `FILIERE` varchar(15) DEFAULT NULL,
  `ID_CLASSE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`ID_MEMBRE`, `CNE`, `APOGEE`, `FILIERE`, `ID_CLASSE`) VALUES
(37, 'R78985611003', '17502287', 'sma', NULL),
(38, 'R12478963', '17512369', 'smp', NULL),
(44, 'R49899743', '14725836', 'sma', NULL),
(45, '77998', '17506779', 'mi', NULL),
(47, 'oa', 'oa', 'sma', NULL),
(54, 'R133611330', '1780', 'smp', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `departement` varchar(35) DEFAULT NULL,
  `nom` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `departement`, `nom`) VALUES
(1, 'info', 'smp'),
(2, 'physique', 'sma');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `ID_MEMBRE` int(11) NOT NULL,
  `NOM` varchar(20) DEFAULT NULL,
  `PRENOM` varchar(20) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  `EMAIL` varchar(20) DEFAULT NULL,
  `PWD` varchar(20) DEFAULT NULL,
  `TELEPHONE` varchar(13) DEFAULT NULL,
  `NATIONALITE` varchar(30) DEFAULT NULL,
  `CIN` varchar(10) DEFAULT NULL,
  `PSEUDONYME` varchar(20) DEFAULT NULL,
  `role` varchar(3) NOT NULL,
  `etat` enum('I','C') NOT NULL DEFAULT 'I',
  `photo` varchar(100) DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`ID_MEMBRE`, `NOM`, `PRENOM`, `DATE_NAISSANCE`, `EMAIL`, `PWD`, `TELEPHONE`, `NATIONALITE`, `CIN`, `PSEUDONYME`, `role`, `etat`, `photo`) VALUES
(37, 'knya', 'smya', '2000-08-14', 'aa', 'aa', '0602187455', 'Egypte', 'BE146699', 'hada_test_2000', 's', 'C', 'profile.png'),
(38, 'ali', 'zawa', '2003-02-17', 'ali', 'zawa', '00212447798', 'Guinee', 'Bk556472', 'a_zawa', 's', 'C', 'profile.png'),
(44, 'meme', 'anana', '2001-08-09', 'onana', 'onana', '000000000', 'germany', 'AZAZAZAZAA', 'sgqrg', 's', 'C', 'profile.png'),
(45, 'Youssef', 'Zaidoune', '1999-09-11', 'zaidouney@gmail.com', 'aa', '0606060', 'mrc', '7779797', 'y.zdn', 's', 'C', 'profile.png'),
(47, 'oa', 'oa', '2000-11-04', 'oa', 'oa', 'oa', 'oa', 'oa', 'zpzzp', 's', 'C', 'profile.png'),
(48, 'rim', 'elazrak', '0000-00-00', 'rimelazak2@gmail.com', 'vv', '+212612082344', '', 'Bk683733', 'RIRI', 's', 'C', 'profile.png'),
(49, 'ali', 'dada', '0000-00-00', 'dada.ali@gmail', 'dada', '0987', '', 'Bk68371', 'DADAAA', 's', 'C', 'profile.png'),
(50, 'zak', 'fahim', '0000-00-00', 'zak-fahim@', 'zed', '+212612082344', '', 'Bk683733', 'zed', 's', 'C', 'profile.png'),
(52, 'zod', '-iac', '0000-00-00', 'zodiac@dd.fr', 'zod', '+212612082344', '', 'Bk683733', 'RIRI', 's', 'C', 'profile.png'),
(53, 'test', 'test', '0000-00-00', 'yesy@com', 'tt', '+212612082344', '', 'Bk683733', 'tetst', 's', 'C', 'profile.png'),
(54, 'rim', 'elazrak', '0000-00-00', 'rimelazak2@gmail.com', 'vv', '+212612082344', '', 'Bk683733', 'RIRI', 's', 'C', 'profile.png'),
(55, 'brian', 'Cox', '2020-06-03', 'physics@nasa.gov', 'mdp', '+212612082344', 'American', 'Bk68', 'Brian_Cox', 'p', 'C', 'profile.png'),
(56, 'prof', 'jalal', '2013-02-08', 'jalal@gmail.com', 'jj', '0612082344', 'maroc', 'Bk683733', 'jilali', 'p', 'C', 'profile.png'),
(57, 'prof', 'dada', '0000-00-00', 'physics@nasa.gov', 'dd', '', '', '', '', 'p', 'C', 'profile.png'),
(58, 'rim', 'elazrak', NULL, 'rim-lazrag@hotmail.f', 'pp', NULL, NULL, NULL, NULL, 's', 'I', 'profile.png');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `ID_MSG` int(11) NOT NULL,
  `TYPE_MSG` varchar(254) DEFAULT NULL,
  `CONTENU_MSG` varchar(254) DEFAULT NULL,
  `DATE_MSG` varchar(254) DEFAULT NULL,
  `ID_MEMBRE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `ID_MODULE` int(11) NOT NULL,
  `NOM_MODULE` varchar(20) DEFAULT NULL,
  `ID_SEMESTRE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `ID_MEMBRE` int(11) NOT NULL,
  `PPR` varchar(5) DEFAULT NULL,
  `DEPARTEMENT` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`ID_MEMBRE`, `PPR`, `DEPARTEMENT`) VALUES
(55, '123', 'smpc'),
(56, '926', 'svtu'),
(57, 'gg', 'smpc');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `ID_PUB` int(11) NOT NULL,
  `CONTENU_PUB` varchar(254) DEFAULT NULL,
  `TITRE_PUB` varchar(254) DEFAULT NULL,
  `DATE_PUB` datetime DEFAULT NULL,
  `ID_MEMBRE` int(11) DEFAULT NULL,
  `visibilite` enum('all','classe','fil') NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`ID_PUB`, `CONTENU_PUB`, `TITRE_PUB`, `DATE_PUB`, `ID_MEMBRE`, `visibilite`) VALUES
(56, 'hi there', 'post title ', '2020-07-02 13:35:56', 57, 'all'),
(57, 'hi there', 'post title ', '2020-07-02 13:39:06', 57, 'all'),
(58, 'bla ba', 'rim test', '2020-07-02 13:40:17', 57, 'all'),
(59, 'bla ba', 'rim test', '2020-07-02 13:40:56', 57, 'all'),
(60, 'bla ba', 'rim test', '2020-07-02 13:41:49', 57, 'all');

-- --------------------------------------------------------

--
-- Structure de la table `pubupdate`
--

CREATE TABLE `pubupdate` (
  `id` int(11) NOT NULL,
  `ID_PUB` int(11) NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pubview`
--

CREATE TABLE `pubview` (
  `ID` int(11) NOT NULL,
  `ID_PUB` int(11) DEFAULT NULL,
  `ID_MEMBRE` int(11) DEFAULT NULL,
  `ID_CLASSE` int(11) DEFAULT NULL,
  `ID_FILIERE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pubview`
--

INSERT INTO `pubview` (`ID`, `ID_PUB`, `ID_MEMBRE`, `ID_CLASSE`, `ID_FILIERE`) VALUES
(64, 56, 57, NULL, NULL),
(65, 57, 57, NULL, NULL),
(66, 58, 57, NULL, NULL),
(67, 59, 57, NULL, NULL),
(68, 60, 57, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE `semestre` (
  `ID_SEMESTRE` int(11) NOT NULL,
  `NOM_SEMESTRE` varchar(10) DEFAULT NULL,
  `ID_FILIERE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`ID_MEMBRE`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`ID_CLASSE`),
  ADD UNIQUE KEY `NOM_CLASSE` (`NOM_CLASSE`),
  ADD KEY `ID_MEMBRE` (`ID_MEMBRE`);

--
-- Index pour la table `classes_joined`
--
ALTER TABLE `classes_joined`
  ADD PRIMARY KEY (`ID_MEMBRE`),
  ADD KEY `ID_CLASSE1` (`ID_CLASSE1`,`ID_CLASSE2`,`ID_CLASSE3`,`ID_CLASSE4`,`ID_CLASSE5`,`ID_CLASSE6`,`ID_CLASSE7`,`ID_CLASSE8`);

--
-- Index pour la table `classes_made`
--
ALTER TABLE `classes_made`
  ADD PRIMARY KEY (`ID_MEMBRE`),
  ADD KEY `ID_CLASSE0` (`ID_CLASSE0`,`ID_CLASSE1`,`ID_CLASSE2`,`ID_CLASSE3`,`ID_CLASSE4`,`ID_CLASSE5`,`ID_CLASSE6`,`ID_CLASSE7`,`ID_CLASSE8`,`ID_CLASSE9`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`ID_COMM`),
  ADD KEY `commentaire_dans_pub` (`ID_PUB`),
  ADD KEY `qui_a_commente` (`ID_MEMBRE`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`ID_MEMBRE`),
  ADD KEY `classeDeLetudiant` (`ID_CLASSE`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`ID_MEMBRE`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID_MSG`),
  ADD KEY `FK_Association_1` (`ID_MEMBRE`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`ID_MODULE`),
  ADD KEY `FK_Association_8` (`ID_SEMESTRE`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`ID_MEMBRE`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`ID_PUB`),
  ADD KEY `FK_Association_9` (`ID_MEMBRE`);

--
-- Index pour la table `pubupdate`
--
ALTER TABLE `pubupdate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mettre_a_jour` (`ID_PUB`);

--
-- Index pour la table `pubview`
--
ALTER TABLE `pubview`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `pubClasse` (`ID_CLASSE`),
  ADD KEY `pubFiliere` (`ID_FILIERE`),
  ADD KEY `pubMembre` (`ID_MEMBRE`),
  ADD KEY `PUB` (`ID_PUB`);

--
-- Index pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`ID_SEMESTRE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `ID_CLASSE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `ID_COMM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `ID_MEMBRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `ID_MEMBRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `ID_MSG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `ID_MODULE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `ID_MEMBRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `ID_PUB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `pubupdate`
--
ALTER TABLE `pubupdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pubview`
--
ALTER TABLE `pubview`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `semestre`
--
ALTER TABLE `semestre`
  MODIFY `ID_SEMESTRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `FK_Generalization_3` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`);

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `membre_classe` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`);

--
-- Contraintes pour la table `classes_joined`
--
ALTER TABLE `classes_joined`
  ADD CONSTRAINT `classe_member&classe` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `classe` (`ID_MEMBRE`);

--
-- Contraintes pour la table `classes_made`
--
ALTER TABLE `classes_made`
  ADD CONSTRAINT `creator&class` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `classe` (`ID_MEMBRE`),
  ADD CONSTRAINT `creator&membre` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_dans_pub` FOREIGN KEY (`ID_PUB`) REFERENCES `publication` (`ID_PUB`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qui_a_commente` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `classeDeLetudiant` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `membre_est_etudiant` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_Association_1` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_Association_8` FOREIGN KEY (`ID_SEMESTRE`) REFERENCES `semestre` (`ID_SEMESTRE`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `FK_Generalization_1` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `FK_Association_9` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `pubupdate`
--
ALTER TABLE `pubupdate`
  ADD CONSTRAINT `mettre_a_jour` FOREIGN KEY (`ID_PUB`) REFERENCES `publication` (`ID_PUB`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `pubview`
--
ALTER TABLE `pubview`
  ADD CONSTRAINT `PUB` FOREIGN KEY (`ID_PUB`) REFERENCES `publication` (`ID_PUB`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pubClasse` FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pubFiliere` FOREIGN KEY (`ID_FILIERE`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pubMembre` FOREIGN KEY (`ID_MEMBRE`) REFERENCES `membre` (`ID_MEMBRE`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
