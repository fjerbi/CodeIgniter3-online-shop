-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 17 avr. 2018 à 12:39
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `djerbashop`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
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
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `prix_produit`, `description_produit`, `image_produit`, `image_mini`, `ancien_prix`, `status`, `url_produit`, `quantite_produit`, `category`) VALUES
(38, 'Samsung s4', '125.00', 'ssssssssssssssssssssssssss', 'shipping3.jpg', 'shipping3.jpg', '155.00', 1, 'Samsung-s4', 25, 1),
(39, 'Samsung s5', '1.00', 'nnnnnnnnnnn', 'shipping4.jpg', 'shipping4.jpg', '155.00', 1, 'Samsung-s5', 25, 1),
(41, 'Samsung s45', '1.00', 'aa', 'images52.jpg', 'images52.jpg', '155.00', 1, 'Samsung-s45', 25, 0),
(42, 'Samsung s4ssd', '125.00', 'aazaz', 'shipping71.jpg', 'shipping71.jpg', '155.00', 1, 'Samsung-s4ssd', 25, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
