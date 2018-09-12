-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2018 at 03:55 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeignitershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `url_page` varchar(255) NOT NULL,
  `titre_page` varchar(255) NOT NULL,
  `motcle_page` text NOT NULL,
  `description_page` text NOT NULL,
  `contenu_page` text NOT NULL,
  `date_publication` int(11) NOT NULL,
  `auteur` varchar(60) NOT NULL,
  `image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `url_page`, `titre_page`, `motcle_page`, `description_page`, `contenu_page`, `date_publication`, `auteur`, `image`) VALUES
(1, 'LE-E-COMMERCE', 'LE E COMMERCE', 'ECOMMERCE', 'ECOMMERCE', 'esttesttesttesttesttesttesttesttesttesttesttest\r\ntesttesttesttesttesttesttesttesttesttesttesttest\r\ntesttesttesttesttesttesttesttesttesttesttesttest', 1519970400, 'Admininistrateur', '6gzjPYScYu2nZhpN.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom_categorie` varchar(255) NOT NULL,
  `url_categorie` varchar(255) NOT NULL,
  `id_categorie_parent` int(11) NOT NULL,
  `priorite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom_categorie`, `url_categorie`, `id_categorie_parent`, `priorite`) VALUES
(35, '<b>FEUILLARD TEXTILE </b>', 'FEUILLARD-TEXTILE', 0, 1),
(36, '<b> Feuillard acier </b>', 'Feuillard-acier', 35, 1),
(37, '<b>Feuillard metallique</b>', 'Feuillard-metallique', 35, 2),
(38, '<b>Feuillard polyester</b>', 'Feuillard-polyester', 35, 3),
(39, '<b> Feuillard polypropylene</b>', 'Feuillard-polypropylene', 35, 4),
(41, '<b>MICROMETRE</b>', 'MICROMETRE', 0, 3),
(42, '<b>FIL RECUIT</b>', 'FIL-RECUIT', 0, 5),
(43, '<b>VISCOSIMÈTRE</b>', 'VISCOSIMETRE', 0, 2),
(44, '<b>LAME DE RACLE</b>', 'LAME-DE-RACLE', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categorie_produit`
--

CREATE TABLE `categorie_produit` (
  `id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie_produit`
--

INSERT INTO `categorie_produit` (`id`, `id_cat`, `id_produit`) VALUES
(56, 36, 43),
(57, 36, 44),
(58, 36, 45),
(59, 36, 46),
(60, 36, 47),
(61, 36, 48),
(62, 36, 49),
(63, 36, 50),
(64, 36, 51),
(65, 36, 52),
(66, 36, 53),
(67, 37, 57);

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `message` text NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`id`, `username`, `message`, `ip`, `date`) VALUES
(1, 'demo123', 'hello', '::1', '2018-09-11 22:42:24'),
(2, 'demo12345', 'testing the chatroom', '::1', '2018-09-11 22:42:35'),
(3, 'demo999', 'hello', '::1', '2018-09-11 22:43:13'),
(4, 'testingdemo', 'Yo', '::1', '2018-09-12 15:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('d692iruept98f2k0lb0o9t8meqvnsm81', '::1', 1536760185, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363736303138343b);

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `libelle_commande` varchar(6) NOT NULL,
  `date_creation` int(11) NOT NULL,
  `id_paypal` int(11) NOT NULL,
  `session_id` varchar(64) NOT NULL,
  `ouvert` tinyint(4) NOT NULL,
  `statut_commande` int(11) NOT NULL,
  `id_acheteur` int(11) NOT NULL,
  `mc_gross` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `libelle_commande`, `date_creation`, `id_paypal`, `session_id`, `ouvert`, `statut_commande`, `id_acheteur`, `mc_gross`) VALUES
(89, 'UWEPNA', 1527846152, 3, '6frovp9mknck7jh63jcdcqg0kjl6fu34', 1, 1, 23, '0.00'),
(90, 'R3WYZK', 1528270842, 3, '6frovp9mknck7jh63jcdcqg0kjl6fu34', 1, 3, 23, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `date_creation` int(11) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_produit`, `date_creation`, `commentaire`) VALUES
(21, 37, 1523354658, 'aaaa'),
(22, 37, 1523354668, 'aaazzzz'),
(23, 36, 1523392086, 'salut'),
(24, 39, 1523395518, 'test'),
(25, 36, 1523396568, 'test'),
(26, 36, 1523396587, 'lol'),
(27, 36, 1523434776, 'test'),
(28, 39, 1523484641, 'mm'),
(29, 38, 1523484668, 'wo'),
(30, 41, 1523983437, 'Un trés bon produit'),
(31, 46, 1523998907, 'Trés bon produit !!'),
(32, 43, 1524002840, 'Bon produit ..'),
(33, 43, 1524654028, 'oui'),
(34, 52, 1524863451, 'test'),
(35, 44, 1525375848, 'test'),
(36, 53, 1526239490, '..'),
(37, 51, 1527255026, 'Trés bon produit');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrateur'),
(2, 'members', 'utilisateur'),
(3, 'commercial', 'commerce');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `date_creation` int(11) NOT NULL,
  `envoye_par` int(11) NOT NULL,
  `envoye_a` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ouvert` int(1) NOT NULL,
  `code` varchar(8) NOT NULL,
  `urgent` tinyint(1) NOT NULL,
  `username` varchar(60) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `date_creation`, `envoye_par`, `envoye_a`, `sujet`, `message`, `ouvert`, `code`, `urgent`, `username`, `datetime`) VALUES
(60, 1522759182, 23, 0, 'salut', 'test', 1, 'hgSkRXpg', 0, '', '0000-00-00 00:00:00'),
(61, 1522772996, 0, 23, 'Premier Test', 'mm', 1, '3xZUiaw5', 0, '', '0000-00-00 00:00:00'),
(62, 1522834154, 0, 23, 'test03', 'test', 1, 'AvCKNj9j', 0, '', '0000-00-00 00:00:00'),
(63, 1523034765, 0, 23, 'Premier Test', '123', 1, 'XcxL2m8m', 0, '', '0000-00-00 00:00:00'),
(64, 1523351951, 0, 23, 'Premier Test', 'aa', 1, 'KI25szr2', 0, '', '0000-00-00 00:00:00'),
(65, 1523353754, 0, 23, 'aa', 'aa', 1, 'eeRHE9mb', 0, '', '0000-00-00 00:00:00'),
(66, 1524648129, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estCommandes expédiées.', 1, 'roqrzCEp', 0, '', '0000-00-00 00:00:00'),
(67, 1524746352, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estInconnu.', 1, 'HZRmAXSD', 0, '', '0000-00-00 00:00:00'),
(68, 1524849291, 0, 24, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estCommandes en cours .', 0, 'tx5Ue2ow', 0, '', '0000-00-00 00:00:00'),
(69, 1524955285, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estCommandes en cours .', 1, 'iNoWNyB9', 0, '', '0000-00-00 00:00:00'),
(70, 1524997760, 0, 23, 'test', 'test', 1, 'EetzNVyR', 0, '', '0000-00-00 00:00:00'),
(71, 1525250127, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estCommandes reçu.', 1, 'MScs8qxQ', 0, '', '0000-00-00 00:00:00'),
(72, 1527065399, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estCommandes expédiées.', 1, 'dqSMdcKh', 0, '', '0000-00-00 00:00:00'),
(73, 1527499928, 3, 0, 'jj', 'nn', 0, 'XG3ETwnn', 1, '', '0000-00-00 00:00:00'),
(74, 1528031277, 0, 23, 'message le 03/06/2018', 'Bonjour, ceci est un message test', 1, 'Xc35VwrF', 0, '', '0000-00-00 00:00:00'),
(75, 1528033823, 0, 23, 'Test SFE', 'SALUT', 1, 'i7VSZWU6', 0, '', '0000-00-00 00:00:00'),
(76, 1528065519, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estCommandes expédiées.', 1, 'ztE2rBXn', 0, '', '0000-00-00 00:00:00'),
(77, 1528210209, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estInconnu.', 1, 'IDHtC6Tv', 0, '', '0000-00-00 00:00:00'),
(78, 1529579067, 0, 23, 'Mise à jour de votre commande', 'Commandea été mise à jour.Le nouveau statut de votre commande estCommandes en cours .', 1, 'gt5rmfbq', 0, '', '0000-00-00 00:00:00'),
(79, 1529579235, 0, 23, 'Mise à jour de votre commande', 'Commande a été mise à jour.Le nouveau statut de votre commande estCommandes expédiées.', 1, '5qnoiMU6', 0, '', '0000-00-00 00:00:00'),
(80, 1529579451, 0, 23, 'Mise à jour de votre commande', 'CommandeUWEPNA a été mise à jour.Le nouveau statut de votre commande estCommandes en cours .', 1, 'p6vUedBm', 0, '', '0000-00-00 00:00:00'),
(81, 1529579557, 0, 23, 'Mise à jour de votre commande', 'Commande UWEPNA a été mise à jour.Le nouveau statut de votre commande estCommandes expédiées.', 1, 'kYiaG8Jb', 0, '', '0000-00-00 00:00:00'),
(82, 1529741502, 0, 23, 'Mise à jour de votre commande', 'Commande R3WYZK a été mise à jour.Le nouveau statut de votre commande estCommandes reçu.', 0, 'tWGaTD9Q', 0, '', '0000-00-00 00:00:00'),
(83, 1529741515, 0, 23, 'Mise à jour de votre commande', 'Commande R3WYZK a été mise à jour.Le nouveau statut de votre commande estCommandes en cours .', 0, 'cHGSvyQM', 0, '', '0000-00-00 00:00:00'),
(84, 1529741577, 0, 23, 'Mise à jour de votre commande', 'Commande R3WYZK a été mise à jour.Le nouveau statut de votre commande estCommandes expédiées.', 0, 'kUxZFpAm', 0, '', '0000-00-00 00:00:00'),
(85, 1529741589, 0, 23, 'Mise à jour de votre commande', 'Commande UWEPNA a été mise à jour.Le nouveau statut de votre commande estCommandes reçu.', 1, 'nY67Yxkb', 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `offre`
--

CREATE TABLE `offre` (
  `id` int(11) NOT NULL,
  `titre_block` varchar(255) NOT NULL,
  `priorite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offre`
--

INSERT INTO `offre` (`id`, `titre_block`, `priorite`) VALUES
(2, '<h4>promotion jusqu\'à épuisement du stock <h4>', 1),
(7, '<h4>promotion  jusqu\'au 30 Aout<h4>', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`id`, `block_id`, `id_produit`) VALUES
(52, 7, 46),
(55, 2, 53),
(56, 2, 51),
(57, 2, 54),
(58, 2, 53),
(59, 7, 54),
(60, 7, 53),
(62, 7, 53);

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `hash` varchar(32) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online`
--

INSERT INTO `online` (`hash`, `ip`, `last_update`) VALUES
('6e7a14dbeca29aed519e3ff38d1708b7', '::1', '2018-09-12 15:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `page_web_cms`
--

CREATE TABLE `page_web_cms` (
  `id` int(11) NOT NULL,
  `url_page` varchar(255) NOT NULL,
  `titre_page` varchar(255) NOT NULL,
  `motcle_page` text NOT NULL,
  `description_page` text NOT NULL,
  `contenu_page` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_web_cms`
--

INSERT INTO `page_web_cms` (`id`, `url_page`, `titre_page`, `motcle_page`, `description_page`, `contenu_page`) VALUES
(1, '', 'Page d\'accueil', 'Accueil', 'Hello', '&nbsp;');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `session_id` varchar(64) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `tax` decimal(7,2) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite_produit` int(11) NOT NULL,
  `date_ajout` int(11) NOT NULL,
  `id_acheteur` int(11) NOT NULL,
  `address_ip` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id`, `session_id`, `nom_produit`, `prix`, `tax`, `id_produit`, `quantite_produit`, `date_ajout`, `id_acheteur`, `address_ip`) VALUES
(179, '17e4ou88a3indogpi61a7kt7m7fdejkq', 'Feuillard pour agrafeuse de filet tubulaire FT 30', '150.00', '0.00', 43, 1, 1525248572, 0, '127.0.0.1'),
(182, 'rbt9i0tteuatrsievmcl0ek0ji2dhv0t', 'Feuillard pour agrafeuse de filet tubulaire FT 30', '150.00', '0.00', 43, 1, 1525866499, 0, '127.0.0.1'),
(193, 'ftlhtva5knmvbosvbbmctnaleet67a2s', 'Feuillard plastique et acier', '250.00', '0.00', 44, 1, 1526734829, 38, '127.0.0.1'),
(199, '9omqg4h3g4ma1pj2433iteu8mho6b1n1', 'Pack cerclage industriel acier', '1254.00', '0.00', 53, 2, 1527254727, 40, '127.0.0.1'),
(201, 'gcap1t75rue31ifn3uhqlg6kllh79rja', 'Feuillard plastique et acier', '250.00', '0.00', 44, 1, 1527413454, 1, '127.0.0.1'),
(203, 'k2um3tck8pqnt1i89o69d5si7h7hvlcc', 'Feuillard acier multispire de la marque CENPAC', '1500.00', '0.00', 48, 1, 1527603012, 0, '127.0.0.1'),
(204, 'sopnaa085lu6pttorp00r44p2pgdio4t', 'Pack cerclage industriel acier', '1254.00', '0.00', 53, 1, 1527603814, 0, '127.0.0.1'),
(205, '35ar50gmejgikal7s36q78geli0kigvo', 'Feuillard acier multispire de la marque CENPAC', '1500.00', '0.00', 48, 1, 1527683170, 0, '127.0.0.1'),
(214, '946uaoj6logcs4jdd2bj1l4hr8kuqprj', 'Feuillard plastique et acier', '250.00', '0.00', 44, 1, 1528542131, 0, '::1'),
(215, 'pe8iqfscakh9gerkf43rcv7ca81ntv72', 'Cisaille - Feuillard acier de la marque MANUTAN', '1578.00', '0.00', 51, 1, 1529580450, 3, '::1'),
(216, 'ndtl8fnjj0tpmiffl9i7ijbb2ojfqav0', 'Cisaille - Feuillard acier de la marque MANUTAN', '1578.00', '0.00', 51, 5, 1529740016, 0, '::1'),
(217, '5t2kpuftohleo4vnmep6q1je3djnalon', 'Pack cerclage industriel acier', '1254.00', '0.00', 53, 1, 1529740401, 62, '::1'),
(218, 'oo8nihbaq5p6239v3nm3o8m20d1odga7', 'Feuillard plastique et acier', '250.00', '0.00', 44, 6, 1529740475, 62, '::1'),
(220, '0smj20ica7khc2qedn695o03o9pd55j4', 'test2019', '1258.00', '0.00', 57, 1, 1529741303, 3, '::1'),
(221, 'u1sd19btme7tcd5d5fo6irkvk63tdn8u', 'Pack cerclage industriel acier', '1254.00', '0.00', 53, 25, 1536698521, 63, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `payement`
--

CREATE TABLE `payement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `addresse1` varchar(255) NOT NULL,
  `addresse2` varchar(255) NOT NULL,
  `num_tel` int(11) NOT NULL,
  `code_postal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paypal`
--

CREATE TABLE `paypal` (
  `id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `post_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paypal`
--

INSERT INTO `paypal` (`id`, `date_created`, `post_info`) VALUES
(3, 1522950598, 'a:42:{s:10:\"mc_gross_1\";s:4:\"0.02\";s:14:\"num_cart_items\";s:1:\"1\";s:8:\"payer_id\";s:12:\"XFDJRTDFDHLJ\";s:20:\"address_country_code\";s:2:\"TN\";s:12:\"ipn_track_id\";s:10:\"z4hlraaxh2\";s:11:\"address_zip\";s:6:\"LW18QT\";s:7:\"charset\";s:12:\"windows-1252\";s:13:\"payment_gross\";s:0:\"\";s:14:\"address_status\";s:9:\"confirmed\";s:14:\"address_street\";s:6:\"Ariana\";s:11:\"verify_sign\";s:39:\"FHEJhfdfdYRCdfsrGRHdfdkKJDFDJKLsiy5aSyk\";s:11:\"mc_shipping\";s:4:\"0.01\";s:8:\"txn_type\";s:4:\"cart\";s:11:\"receiver_id\";s:14:\"LRKJKLje68KLJF\";s:11:\"payment_fee\";s:0:\"\";s:12:\"item_number1\";s:0:\"\";s:11:\"mc_currency\";s:3:\"TND\";s:19:\"transaction_subject\";s:0:\"\";s:6:\"custom\";s:216:\"4b310e4e5c80b33046266d78cfbe3ed1127170bb407e524f5d72a870f9ed5257fb859e80270028e9eb24ac3287c6b998e928df6cd0aa46baa6ffddbbb33b72e488yYcUnSRJfocSEYwimHZfFQBv7XgjneLfNWSWez0mSBPJ0OTvm5IwjTpPG61mnfOABFzSCdvJODxR9Zj1CsYg==\";s:22:\"protection_eligibility\";s:8:\"Eligible\";s:9:\"quantity1\";s:1:\"1\";s:15:\"address_country\";s:7:\"Tunisia\";s:12:\"payer_status\";s:8:\"verified\";s:10:\"first_name\";s:5:\"Firas\";s:10:\"item_name1\";s:17:\"Feuillard Textile\";s:12:\"address_name\";s:16:\"Cite Hedi Nouira\";s:8:\"mc_gross\";s:4:\"0.02\";s:12:\"payment_date\";s:24:\"12:11:00 May 5, 2018 PDT\";s:14:\"payment_status\";s:9:\"Completed\";s:8:\"business\";s:13:\"firas@xxx.com\";s:9:\"last_name\";s:5:\"Jerbi\";s:13:\"address_state\";s:7:\"Tunisia\";s:19:\"payer_business_name\";s:17:\"Some Business Ltd\";s:6:\"txn_id\";s:14:\"98DCDD8LKJKDFD\";s:6:\"mc_fee\";s:4:\"0.02\";s:6:\"resend\";s:4:\"true\";s:12:\"payment_type\";s:7:\"instant\";s:14:\"notify_version\";s:3:\"3.8\";s:11:\"payer_email\";s:20:\"firasbuyer@gmail.com\";s:14:\"receiver_email\";s:23:\"firasmerchant@gmail.com\";s:12:\"address_city\";s:7:\"Tunisia\";s:17:\"residence_country\";s:2:\"TN\";}'),
(4, 1522950598, 'a:42:{s:10:\"mc_gross_1\";s:4:\"0.02\";s:14:\"num_cart_items\";s:1:\"1\";s:8:\"payer_id\";s:12:\"XFDJRTDFDHLJ\";s:20:\"address_country_code\";s:2:\"GB\";s:12:\"ipn_track_id\";s:10:\"z4hlraaxh2\";s:11:\"address_zip\";s:6:\"LW18QT\";s:7:\"charset\";s:12:\"windows-1252\";s:13:\"payment_gross\";s:0:\"\";s:14:\"address_status\";s:9:\"confirmed\";s:14:\"address_street\";s:14:\"Evergreen Road\";s:11:\"verify_sign\";s:39:\"FHEJhfdfdYRCdfsrGRHdfdkKJDFDJKLsiy5aSyk\";s:11:\"mc_shipping\";s:4:\"0.01\";s:8:\"txn_type\";s:4:\"cart\";s:11:\"receiver_id\";s:14:\"LRKJKLje68KLJF\";s:11:\"payment_fee\";s:0:\"\";s:12:\"item_number1\";s:0:\"\";s:11:\"mc_currency\";s:3:\"GBP\";s:19:\"transaction_subject\";s:0:\"\";s:6:\"custom\";s:216:\"4b310e4e5c80b33046266d78cfbe3ed1127170bb407e524f5d72a870f9ed5257fb859e80270028e9eb24ac3287c6b998e928df6cd0aa46baa6ffddbbb33b72e488yYcUnSRJfocSEYwimHZfFQBv7XgjneLfNWSWez0mSBPJ0OTvm5IwjTpPG61mnfOABFzSCdvJODxR9Zj1CsYg==\";s:22:\"protection_eligibility\";s:8:\"Eligible\";s:9:\"quantity1\";s:1:\"1\";s:15:\"address_country\";s:14:\"United Kingdom\";s:12:\"payer_status\";s:8:\"verified\";s:10:\"first_name\";s:5:\"Firas\";s:10:\"item_name1\";s:34:\"Feuillard Textile\";s:12:\"address_name\";s:8:\"Flat 436\";s:8:\"mc_gross\";s:4:\"0.02\";s:12:\"payment_date\";s:25:\"12:11:00 Sep 28, 2016 PDT\";s:14:\"payment_status\";s:9:\"Completed\";s:8:\"business\";s:13:\"firas@xxx.com\";s:9:\"last_name\";s:8:\"Jerbi\";s:13:\"address_state\";s:7:\"Glasgow\";s:19:\"payer_business_name\";s:17:\"Some Business Ltd\";s:6:\"txn_id\";s:14:\"98DCDD8LKJKDFD\";s:6:\"mc_fee\";s:4:\"0.02\";s:6:\"resend\";s:4:\"true\";s:12:\"payment_type\";s:7:\"instant\";s:14:\"notify_version\";s:3:\"3.8\";s:11:\"payer_email\";s:19:\"payments@yyyy.co.uk\";s:14:\"receiver_email\";s:13:\"firas@xxx.com\";s:12:\"address_city\";s:7:\"Glasgow\";s:17:\"residence_country\";s:2:\"GB\";}');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `prix_produit` decimal(7,2) NOT NULL,
  `description_produit` text NOT NULL,
  `image_produit` varchar(255) NOT NULL,
  `image_mini` varchar(255) NOT NULL,
  `ancien_prix` decimal(7,2) NOT NULL,
  `status` int(1) NOT NULL,
  `url_produit` varchar(255) NOT NULL,
  `quantite_produit` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `shipping` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `prix_produit`, `description_produit`, `image_produit`, `image_mini`, `ancien_prix`, `status`, `url_produit`, `quantite_produit`, `category`, `shipping`) VALUES
(43, 'Feuillard pour agrafeuse de filet tubulaire FT 30', '150.00', 'Disposé en bobine, le feuillard pour agrafeuse de filet tubulaire FT 30 est utilisé pour fermer le filet via l\'agrafeuse qui pose deux agrafes et coupe en même temps le filet.\r\n\r\nD\'une utilisation très répandue, cet équipement d\'emballage est utilisé dans le domaine de l\'agroalimentaire pour les fruits, les légumes et autres, pour les métiers de la mer, les industries …', 'feuillard-pour-agrafeuse-de-filet-tubulaire-ft-30-008657055-product_zoom.jpg', 'feuillard-pour-agrafeuse-de-filet-tubulaire-ft-30-008657055-product_zoom.jpg', '200.00', 1, 'Feuillard-pour-agrafeuse-de-filet-tubulaire-FT-30', 1500, 0, 0),
(44, 'Feuillard plastique et acier', '250.00', 'FEUILLARD ACIER\r\nFeuillard plastique et acier\r\nVotez\r\nUne gamme complète de feuillard pour cerclage manuel et automatique ainsi que tous les consommables associés (boucles , chapes , ….) \r\n\r\nUtilisation du feuillard\r\n\r\n1°) Feuillard ou cerclage acier\r\nRéservé aux charges lourdes voire très lourdes, le cerclage en feuillard acier fait appel à un outillage spécifique et nécessite une application rigoureuse pour un maintien correct des produits à emballer.\r\n\r\n2°) Feuillard Polypropylène = PP\r\nEn manuel comme en machine, ce produit léger et facile d’utilisation offre de par une gamme très large une multitude possibilité (renforcement ou protection de petit colis ou grand colis, jusqu’au cerclage de maintien d’une palette complète), toutes les qualités et toutes les épaisseurs adaptable à tous les appareils ou machine de cerclage.\r\n\r\n3°) Feuillard textile\r\nFeuillard simple ou renforcé à base de fils polypropylène haute résistance positionnés parallèlement et collés par enduction hot melt, ce feuillard convient pour le maintien de charges courantes à lourdes.\r\n\r\n4°) Feuillard Polyester = PET\r\nLéger, souple, facile d’utilisation, ce matériau offre toutes les qualités pour une alternative intéressante au feuillard acier. Son rendement en fait un produit très avantageux sur le plan économique.\r\nLe feuillard polyester est adapté au cerclage de charges lourdes.\r\n\r\nLes plus du Feuillard plastique:\r\n\r\n1-Meilleure résistance aux chocs\r\n2-Manipulation sans risque pour l’opérateur\r\n3-Résistance à l’humidité : ne rouille pas et ne se détend pas\r\n4-Résistance à la température (80ºC) et aux U.V.', 'feuillard-plastique-et-acier-000080821-product_zoom.jpg', 'feuillard-plastique-et-acier-000080821-product_zoom.jpg', '350.00', 1, 'Feuillard-plastique-et-acier', 1400, 0, 0),
(45, 'Pack cerclage economique acier', '500.00', 'Ce pack contient :1 galette de feuillard acier monospire 16x0.5mm.Forte résistance à la rupture. Faible allongement et bonne conservation de la tension dans le temps. Ø intérieur 406mm. Vendue sous le code MFC407.1 chariot dévidoir. Pour bobines lourdes Ø intérieur 406mm. En tube acier. Vendu sous le code MFC92.1 tendeur-sertisseur.Economique, pour usage modéré. Fermeture par matrissage. Pour feuillard acier 12.7, 16 et 19mm. Vendu sous le code D69R.1 paire de lunettesHaute protection.1 paire de gants.Pour travailler sans vous blesser.1 cisaille de sécurité TYMER.Pour couper le feuillard acier sans risque. Vendue sous le code 69000.', 'pack-cerclage-economique-acier-007675110-product_zoom.jpg', 'pack-cerclage-economique-acier-007675110-product_zoom.jpg', '650.00', 1, 'Pack-cerclage-economique-acier', 23650, 0, 0),
(46, ' Feuillard acier laque monospire type RW', '254.00', 'Forte résistance à la rupture : permet le cerclage de charges très lourdes, rigides, peu comprésibles (béton, acier) ou avec arrêtes saillantes ou coupantes, de bottes rondes (barres, tubes, profilés, bobines...).Faible allongement et excellente conservation de la tension dans le temps.Résistance à température élevée jusqu\'à 350°C.Glisse bien sur les produits, ne rouille pas, non graisseux.Recyclable.Equipements complémentaires :Chariot-dévidoir code MFC92Tendeur-sertisseur codes D69R ou JK1219Pack de cerclage code MFC407KCEn acier laminé, laqué et ciré, bords ébavurés. Qualité standard selon norme NF EN 13246.Bobine Ø int. 300 mm.', 'feuillard-acier-laque-monospire-type-rw-007777975-product_zoom.jpg', 'feuillard-acier-laque-monospire-type-rw-007777975-product_zoom.jpg', '300.00', 1, 'Feuillard-acier-laque-monospire-type-RW', 2560, 0, 0),
(47, 'FEUILLARD ACIER Feuillard acier galvanise perfore', '254.00', 'Bandes de montage et de contreventement conçues pour les charpentes de toiture en bois et les châssis utilisés dans les métiers de la construction.  Le feuillard galvanisé à trous est aussi utilisé pour la fabrication de produits emboutis et formés à froid. Ou la quncaillerie. Conformes à la norme EN 10142.Acier DX51D galvanisé à chaud Z150-275. *  Epaisseur : 1mm et 1,5 mm  *  Diamètre des trous : 5 et 8 mm *  Largeur : 25 et 30 mm *  Rupture de charge - Rm : 500 (=N/mm²) *  Résistance élastique ? Re (mpa)  : > = 140 (N/mm2) *  Allongement >= 22 % Conditionnement > rouleau de 25 m ', 'feuillard-acier-galvanise-perfore-003710710-product_zoom.jpg', 'feuillard-acier-galvanise-perfore-003710710-product_zoom.jpg', '290.00', 1, 'FEUILLARD-ACIER-Feuillard-acier-galvanise-perfore', 2540, 0, 0),
(48, 'Feuillard acier multispire de la marque CENPAC', '1500.00', 'Haute résistance pour les charges les plus lourdes, rigides, saillantes ou coupantes : béton, acier, profilés... Traitement de surface par enduction de peinture pour assurer une protection anticorrosion. Résistance aux fortes températures jusqu\'à 350°C. Finition acier laqué noir : conserve ses propriétés même dans des conditions extrêmes.', 'feuillard-acier-multispire-008718415-product_zoom.jpg', 'feuillard-acier-multispire-008718415-product_zoom.jpg', '2500.00', 1, 'Feuillard-acier-multispire-de-la-marque-CENPAC', 2500, 0, 0),
(49, 'Feuillard acier (metal) en bobine trancannee', '1500.00', 'Largeur 12 à 19 mm.', 'feuillard-acier-metal-en-bobine-trancannee-000315032-product_zoom.jpg', 'feuillard-acier-metal-en-bobine-trancannee-000315032-product_zoom.jpg', '2000.00', 1, 'Feuillard-acier-metal-en-bobine-trancannee', 2548, 0, 0),
(50, 'Feuillard en acier a serrage par vis', '1230.00', 'Système de fixation adapté aux supports permettant l\'usage de brides et de rails standards (ex. poteaux aux profil irrégulier, candélabres, pilliers...).. Simple à disposer et à utiliser sur tous panneaux rigides (PVC, alu, plexi...).. Un feuillard ne peut pas être coupé pour être utilisé plusieurs fois : il n\'y a qu\'une seule chape de fermeture par feuillard.. Feuillard à utiliser avec un ainsi qu\'un FE TEND.', 'feuillard-en-acier-a-serrage-par-vis-004559260-product_zoom.jpg', 'feuillard-en-acier-a-serrage-par-vis-004559260-product_zoom.jpg', '1500.00', 1, 'Feuillard-en-acier-a-serrage-par-vis', 2569, 0, 0),
(51, 'Cisaille - Feuillard acier de la marque MANUTAN', '1578.00', 'Cisaille - Feuillard acierCisaille robuste et légère.', 'cisaille-feuillard-acier-008146580-product_zoom.jpg', 'cisaille-feuillard-acier-008146580-product_zoom.jpg', '1600.00', 1, 'Cisaille-Feuillard-acier-de-la-marque-MANUTAN', 5512, 0, 0),
(52, 'Feuillard acier laque monospire type RW pods 24 kg', '1250.00', 'Forte résistance à la rupture : permet le cerclage de charges très lourdes, rigides, peu comprésibles (béton, acier) ou avec arrêtes saillantes ou coupantes, de bottes rondes (barres, tubes, profilés, bobines...).Faible allongement et excellente conservation de la tension dans le temps.Résistance à température élevée jusqu\'à 350°C.Glisse bien sur les produits, ne rouille pas, non graisseux.Recyclable.Equipements complémentaires :Chariot-dévidoir code MFC92Tendeur-sertisseur codes D69R ou JK1219Pack de cerclage code MFC407KCEn acier laminé, laqué et ciré, bords ébavurés. Qualité standard selon norme NF EN 13246.Bobine Ø int. 300 mm.', 'feuillard-acier-laque-monospire-type-rw-pods-24-kg-008794965-product_zoom.jpg', 'feuillard-acier-laque-monospire-type-rw-pods-24-kg-008794965-product_zoom.jpg', '2000.00', 1, 'Feuillard-acier-laque-monospire-type-RW-pods-24-kg', 2560, 0, 0),
(53, 'Pack cerclage industriel acier', '1254.00', 'Ce pack contient :1 bobine de feuillard acier multispire 16x0.5mm.Forte résistance à la rupture. Faible allongement et bonne conservation de la tension dans le temps. Ø intérieur 406mm. Vendue sous le code MFC404.1 chariot dévidoir. Pour bobines lourdes Ø intérieur 406mm. En tube acier. Vendu sous le code MFC93.1 tendeur-sertisseur JOSEF KIHLBERG.Robuste, pour usage intensif. Facile à utiliser. Fermeture par matrissage. Pour feuillard acier 12.7, 16 et 19mm. Vendu sous le code JK1219.1 paire de lunettesHaute protection.1 paire de gants.Pour travailler sans vous blesser.1 cisaille de sécurité TYMER. Pour couper le feuillard acier sans risque. Vendue sous le code 69000.', 'pack-cerclage-industriel-acier-007675115-product_zoom.jpg', 'pack-cerclage-industriel-acier-007675115-product_zoom.jpg', '1300.00', 1, 'Pack-cerclage-industriel-acier', 2540, 0, 0),
(54, 'test02', '125.00', 'aaa', 'LAME_RUBANS.jpg', 'LAME_RUBANS.jpg', '125.00', 1, 'test02', 25, 0, 0),
(56, 'TEST', '25.00', 'aaa', 'micrometre-40a-cap0-25-56978911.jpg', 'micrometre-40a-cap0-25-56978911.jpg', '21.00', 1, 'TEST', 25, 0, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `shipping` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `titre_slider` varchar(250) NOT NULL,
  `target_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `titre_slider`, `target_url`) VALUES
(6, 'Offre été 2019', 'http://localhost/pfeprojet/');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `target_url` varchar(255) NOT NULL,
  `alt_text` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `parent_id`, `target_url`, `alt_text`, `picture`) VALUES
(8, 6, 'http://localhost/pfeprojet/product/list/Feuillard-plastique-et-acier', 'offre2020s', 'slider26.jpg'),
(9, 6, 'http://localhost/pfeprojet/product/list/Feuillard-plastique-et-acier', 'offre2020', 'feuillard.jpg'),
(10, 6, 'http://localhost/pfeprojet/product/list/Feuillard-plastique-et-acier', 'offre2020', 'LAME_RUBANS.jpg'),
(11, 6, 'http://localhost/pfeprojet/product/list/Feuillard-plastique-et-acier', 'offre2020', 'pack-cerclage-economique-acier-007675110-product_zoom1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int(11) NOT NULL,
  `url_location` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `table_realtime` varchar(255) NOT NULL,
  `timezone` int(11) NOT NULL,
  `latitude` decimal(10,0) NOT NULL,
  `longitude` decimal(10,0) NOT NULL,
  `elevation` varchar(255) NOT NULL,
  `unit_height` int(11) NOT NULL,
  `unit_temp` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statut_commande`
--

CREATE TABLE `statut_commande` (
  `id` int(11) NOT NULL,
  `nom_statut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statut_commande`
--

INSERT INTO `statut_commande` (`id`, `nom_statut`) VALUES
(1, 'Commandes reçu'),
(2, 'Commandes en cours '),
(3, 'Commandes expédiées');

-- --------------------------------------------------------

--
-- Table structure for table `traces_client`
--

CREATE TABLE `traces_client` (
  `id` int(11) NOT NULL,
  `session_id` varchar(64) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `tax` decimal(7,2) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite_produit` int(11) NOT NULL,
  `date_ajout` int(11) NOT NULL,
  `id_acheteur` int(11) NOT NULL,
  `address_ip` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traces_client`
--

INSERT INTO `traces_client` (`id`, `session_id`, `nom_produit`, `prix`, `tax`, `id_produit`, `quantite_produit`, `date_ajout`, `id_acheteur`, `address_ip`) VALUES
(0, '6frovp9mknck7jh63jcdcqg0kjl6fu34', 'Feuillard acier multispire de la marque CENPAC', '1500.00', '0.00', 48, 1, 1527846139, 23, '127.0.0.1'),
(0, '6frovp9mknck7jh63jcdcqg0kjl6fu34', 'Feuillard acier multispire de la marque CENPAC', '1500.00', '0.00', 48, 1, 1527846139, 23, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(5, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'admin@admin.com', 'zeaazenjiana75', NULL, NULL, NULL, 19700101, 1536760139, 1, 'aaa', 'aa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(23, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(70) NOT NULL,
  `nom` varchar(120) NOT NULL,
  `prenom` varchar(65) NOT NULL,
  `societe` varchar(150) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(40) NOT NULL,
  `code_postal` varchar(15) NOT NULL,
  `num_tel` varchar(30) NOT NULL,
  `email` varchar(65) NOT NULL,
  `date_creation` int(11) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `derniere_connexion` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `nom`, `prenom`, `societe`, `address1`, `address2`, `ville`, `pays`, `code_postal`, `num_tel`, `email`, `date_creation`, `mot_de_passe`, `derniere_connexion`, `code`, `active`) VALUES
(63, 'demo123', '', '', '', 'zaijaz', 'aznneajzeo', 'kzaeoa', 'aziej', '', '', 'demo@gmail.com', 1536698422, '$2y$11$xUZPvZSJ6ODW8Ad/pme2W.j94tHrJvsolaWNvmXLaGJYYwUUFAfNS', 0, 'xmYlTsCDvByJ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_cookies`
--

CREATE TABLE `web_cookies` (
  `id` int(11) NOT NULL,
  `code_cookie` varchar(120) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_cookies`
--

INSERT INTO `web_cookies` (`id`, `code_cookie`, `user_id`, `date_expiration`) VALUES
(13, '6rwRncIOxNgSHKuQAoM5HfzXtHewYmC4CvCTjXH4wMbb3rQ8zBpA2H9Be84gS2ARPSMtAJcRPJGrImcKLx4ox2cLK5R7RykxWSpZuFLJGT28aMABtf22Ic2o', 88, 1526201918),
(14, 'ZrQ3znCxz4WZhYRrKg4feKQYCt7LFtGR2WckXpadym3xj6W7glm4if97aG4PZmFsMMo74BcspijUG7JPILXIurgOI2fSaC4YXMlmLgmuWMTFUIvexeHR6rhp', 88, 1526201921),
(15, 'xOZzqCnLuBodKyw7fRzNlYscpkEq4NL3curfiHODkzsxUx6ks2sr5L3aKxOl9f6lpZhyK8eyeqjxIDtxaK89BurghnwtF5RTHqSdshfBIfiQAmORsjPJcsGI', 88, 1526201929);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie_produit`
--
ALTER TABLE `categorie_produit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`hash`);

--
-- Indexes for table `page_web_cms`
--
ALTER TABLE `page_web_cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payement`
--
ALTER TABLE `payement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal`
--
ALTER TABLE `paypal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statut_commande`
--
ALTER TABLE `statut_commande`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_cookies`
--
ALTER TABLE `web_cookies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `categorie_produit`
--
ALTER TABLE `categorie_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `offre`
--
ALTER TABLE `offre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `page_web_cms`
--
ALTER TABLE `page_web_cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `payement`
--
ALTER TABLE `payement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paypal`
--
ALTER TABLE `paypal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statut_commande`
--
ALTER TABLE `statut_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `web_cookies`
--
ALTER TABLE `web_cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
