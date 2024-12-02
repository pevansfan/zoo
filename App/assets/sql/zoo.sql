-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 02 déc. 2024 à 08:21
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `Enclosures_Employees`
--

CREATE TABLE `Enclosures_Employees` (
  `enclos_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Enclosures_Employees`
--
ALTER TABLE `Enclosures_Employees`
  ADD PRIMARY KEY (`enclos_id`,`employee_id`),
  ADD KEY `Enclosures_Employees_Employees_FK` (`employee_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Enclosures_Employees`
--
ALTER TABLE `Enclosures_Employees`
  ADD CONSTRAINT `Enclosures_Employees_Employees_FK` FOREIGN KEY (`employee_id`) REFERENCES `Employees` (`id`),
  ADD CONSTRAINT `Enclosures_Employees_Enclosures_FK` FOREIGN KEY (`enclos_id`) REFERENCES `Enclosures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
