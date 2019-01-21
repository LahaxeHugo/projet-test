-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 14 jan. 2019 à 08:47
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test_back`
--

-- --------------------------------------------------------

--
-- Structure de la table `peintures_info`
--

DROP TABLE IF EXISTS `peintures_info`;
CREATE TABLE IF NOT EXISTS `peintures_info` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_peinture` varchar(255) NOT NULL,
  `current_peinture` varchar(255) NOT NULL,
  `name_peinture` varchar(255) NOT NULL,
  `desc_peinture` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `peintures_info`
--

INSERT INTO `peintures_info` (`id`, `id_peinture`, `current_peinture`, `name_peinture`, `desc_peinture`) VALUES
(18, 'peinture_28', 'peinture_28.png', '100 days till the end', 'en partenaria avec netflix, <b>stanford</b> university, disney, samsung, evernote dab'),
(17, 'peinture_27', 'peinture_27.png', 'Dribble', 'Dribbble is where designers gain inspiration, feedback, community, and jobs and is your best resource to discover and connect with designers worldwide.\r\nDribbble is where designers gain inspiration, feedback, community, and jobs and is your best resource to discover and connect with designers worldwide.Dribbble is where designers gain inspiration, feedback, community, and jobs and is your best resource to discover and connect with designers worldwide.'),
(16, 'peinture_26', 'peinture_26.png', 'Charlie et ses bros', 'Trouvez les tous !');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
