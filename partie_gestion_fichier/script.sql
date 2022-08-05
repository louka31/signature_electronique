-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 28 juin 2022 à 01:25
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE signature ;
use signature ;
CREATE TABLE `historique` (
  `idsignature` int(11) NOT NULL,
  `idutil` int(11) NOT NULL,
  `id_pdf` int(11) NOT NULL,
  `date_signature` datetime NOT NULL DEFAULT current_timestamp(),
  `signature_valide` int(1) NOT NULL
) ;
CREATE TABLE `partage` (
  `id` int(11) NOT NULL,
  `idpdf` int(11) NOT NULL,
  `idstructure` int(11) NOT NULL,
  `idstructure_part` int(11) NOT NULL,
  `date_partage` datetime NOT NULL DEFAULT current_timestamp()
);
CREATE TABLE `structure` (
  `id` int(11) NOT NULL,
  `nom_structure` varchar(30) NOT NULL
) ;
CREATE TABLE `upload` (
  `idd` int(11) NOT NULL,
  `nom_pdf` varchar(30) NOT NULL,
  `size` int(11) NOT NULL,
  `idutil` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `partage` int(1) NOT NULL DEFAULT 0
);
CREATE TABLE `utilisateur` (
  `mot_de_passe` varchar(40) NOT NULL,
  `id` int(11) NOT NULL,
  `compte` int(11) NOT NULL DEFAULT 0,
  `email` varchar(30) NOT NULL,
  `cin` varchar(8) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `idstructure` int(11) NOT NULL,
  `code` int(11) NOT NULL
) ;
CREATE TABLE `repertoire` (
  `path` varchar(30) NOT NULL,
  `id` int(11) NOT NULL
);
INSERT INTO `repertoire` (`path`, `id`) VALUES
('C:\\xampp\\htdocs\\imagesss', 1);
ALTER TABLE `repertoire`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `repertoire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
INSERT INTO `utilisateur` (`mot_de_passe`, `id`, `compte`, `email`, `cin`, `nom`, `prenom`, `idstructure`, `code`) VALUES
('superadmin', 16, 2, 'superadmin', '12345678', 'ben salah', 'ahmed', 1, 0);

ALTER TABLE `historique`
  MODIFY `idsignature` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `partage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `upload`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`idutil`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `historique_ibfk_2` FOREIGN KEY (`id_pdf`) REFERENCES `upload` (`idd`);

ALTER TABLE `partage`
  ADD CONSTRAINT `partage_ibfk_1` FOREIGN KEY (`idpdf`) REFERENCES `upload` (`idd`),
  ADD CONSTRAINT `partage_ibfk_2` FOREIGN KEY (`idstructure`) REFERENCES `structure` (`id`),
  ADD CONSTRAINT `partage_ibfk_3` FOREIGN KEY (`idstructure_part`) REFERENCES `structure` (`id`);

ALTER TABLE `upload`
  ADD CONSTRAINT `upload_ibfk_1` FOREIGN KEY (`idutil`) REFERENCES `utilisateur` (`id`);

ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idstructure`) REFERENCES `structure` (`id`);
COMMIT;
ALTER TABLE `historique`
  ADD PRIMARY KEY (`idsignature`),
  ADD KEY `idutil` (`idutil`),
  ADD KEY `id_pdf` (`id_pdf`);

ALTER TABLE `partage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpdf` (`idpdf`),
  ADD KEY `idstructure` (`idstructure`),
  ADD KEY `idstructure_part` (`idstructure_part`);

ALTER TABLE `structure`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `upload`
  ADD PRIMARY KEY (`idd`),
  ADD KEY `idutil` (`idutil`);

ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsecteur` (`idstructure`);

