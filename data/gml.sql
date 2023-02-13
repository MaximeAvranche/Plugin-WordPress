 /**
  *
  * Par Pois Chiche Design
  * Auteur : Maxime Avranche
  * Créé le 13/02/2023
  * 
 **/

--
-- Configuration de la Base de données
--
-- --------------------------------------------------------
--
-- Structure de la table `wp_gml`
--

DROP TABLE IF EXISTS `wp_gml`;
CREATE TABLE IF NOT EXISTS `wp_gml` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `buisness_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `owner` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `dpo` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `contact` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `rgpd` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `first` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `wp_gml`
--

INSERT INTO `wp_gml` (`ID`, `buisness_name`, `owner`, `dpo`, `contact`, `rgpd`, `content`, `first`) VALUES
(1, null, null, null, null, null, null, 0);
COMMIT;

-- --------------------------------------------------------