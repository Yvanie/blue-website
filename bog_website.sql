-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 mars 2025 à 14:57
-- Version du serveur : 5.7.31-log
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bog_website`
--

-- --------------------------------------------------------

--
-- Structure de la table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `idBlogs` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `idUsers` int(11) NOT NULL,
  `createAt` datetime NOT NULL,
  `updateAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(120) NOT NULL,
  `authors` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idBlogs`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `blogs`
--

INSERT INTO `blogs` (`idBlogs`, `title`, `content`, `idUsers`, `createAt`, `updateAt`, `image`, `authors`) VALUES
(7, 'Network Solutions to Stay Ahead in 2025', 'To stay ahead in 2025, Network Solutions should focus on adapting to emerging technologies, enhancing cybersecurity, and improving customer support. They can invest in AI and automation to streamline processes, offer personalized services, and ensure robust data protection. Staying innovative and responsive to customer needs will help them maintain a competitive edge in the rapidly evolving digital landscape.', 1, '2025-03-11 15:39:09', '2025-03-14 09:35:53', 'Public/img/blogs/contact.png', 'Yvanie'),
(13, 'Boosting Your Business Network in 2025', 'As the digital world rapidly evolves, so must your business network. The performance, reliability, and security of your network are key to staying competitive. In this post, we&amp;amp;amp;amp;amp;rsquo;ll dive into the top strategies and technologies that will help your business network thrive in 2025', 1, '2025-03-12 08:38:30', '2025-03-14 09:34:29', 'Public/img/blogs/general management.jpg', 'Yvanie'),
(14, 'Exploring the Future of Technology', 'Discover how emerging technologies are shaping our world and what the future holds for businesses.Discover how emerging technologies are shaping our world and what the future holds for businesses.', 1, '2025-03-14 10:40:14', '2025-03-14 10:40:14', 'Public/img/blogs/blog1.png', 'By John Doe'),
(15, 'AI and the Future of Work', ' How artificial intelligence is transforming the workplace and creating new opportunities.', 1, '2025-03-14 10:41:23', '2025-03-14 10:41:23', 'Public/img/blogs/image2.jpg', 'By Jane Smith'),
(16, 'Blockchain Beyond Cryptocurrency', ' The applications of blockchain technology across various industries beyond finance.', 1, '2025-03-14 10:43:04', '2025-03-14 10:43:04', 'Public/img/blogs/it.jpg', 'By Mark Wilson'),
(18, 'Testons juste', 'Just for testing ohhh', 1, '2025-03-19 15:40:35', '2025-03-19 15:40:35', 'Public/img/blogs/image3.jpg', 'Tester'),
(20, 'Je veux aimer le codage comme Mr Bishop', 'Je veux Ãªtre comme Mr Bishop, aimer le codage et surtout Ãªtre fiÃ¨re quand j&#039;ai les bugs', 1, '2025-03-19 16:04:05', '2025-03-19 16:04:05', 'Public/img/blogs/home2.png', 'Yvanie');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `idContact` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phoneNumber` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `createAt` timestamp NOT NULL,
  PRIMARY KEY (`idContact`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`idContact`, `username`, `email`, `phoneNumber`, `subject`, `message`, `createAt`) VALUES
(1, 'Yvanie Noelle', 'noelle@gmail.com', '694526505', 'I want to know more about Blue Ocean Group', 'I have learn about Blue Ocean Group from a friend, he told me that the enterprise focuses on telecommunication, Network and other things. I want to know more about the company and see if it will be beneficial to our company', '2025-03-05 09:13:05');

-- --------------------------------------------------------

--
-- Structure de la table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE IF NOT EXISTS `newsletters` (
  `idNewsletters` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `createAt` timestamp NOT NULL,
  `confirmtoken` varchar(300) DEFAULT NULL,
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'disabled',
  PRIMARY KEY (`idNewsletters`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletters`
--

INSERT INTO `newsletters` (`idNewsletters`, `email`, `createAt`, `confirmtoken`, `status`) VALUES
(9, 'ndarabumwoya@gmail.com', '2025-03-21 14:16:53', '953dd5cb-2122-4c27-a554-4d4a99fdeac8', 'disabled'),
(10, 'nwouatouyvanienoelle@gmail.com', '2025-03-21 14:17:33', 'ce30aaa8-8f56-41a2-9934-b686cac0042c', 'disabled');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `status` enum('enable','disable') NOT NULL,
  `createdAt` timestamp NOT NULL,
  `creator` int(11) NOT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUsers`, `username`, `email`, `password`, `role`, `status`, `createdAt`, `creator`) VALUES
(1, 'Yvanie Noelle', 'yvanie@gmail.com', '$2y$10$QlsNsP3lzViaccUqrKKeauavXSlCxW/vBx7.8IuFBXroH15gdwBxW', 'admin', 'enable', '2025-02-03 08:17:40', 1),
(5, 'Mr Bishop', 'bishop@gmail.com', '$2y$10$OeIUfsHBbmhBmROuyTSTFeVvPzHKSbOujPXhukP0s/DT4K.eQj.aG', 'admin', 'enable', '2025-01-23 11:47:16', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
