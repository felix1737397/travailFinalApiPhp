DROP DATABASE IF EXISTS bibliotheque; 
CREATE DATABASE bibliotheque;
USE bibliotheque; 


CREATE TABLE `livre` (
  `id_livre` int PRIMARY KEY AUTO_INCREMENT,
  `prenom_auteur` varchar(255),
  `nom_famille_auteur` varchar(255),
  `titre` varchar(255),
  `nb_page` int,
  `isbn` bigint,
  `date_publication` varchar(255),
  `langue` varchar(255),
  `collection` varchar(255),
  `tome` int,
  `image` varchar(255)
);

CREATE TABLE `user` (
  `id_user` int PRIMARY KEY AUTO_INCREMENT,
  `prenom_user` varchar(255),
  `nom_user` varchar(255),
  `cle_api` varchar(255)
);