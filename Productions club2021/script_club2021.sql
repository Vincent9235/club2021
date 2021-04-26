#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Roles
#------------------------------------------------------------

CREATE TABLE Roles(
        roles_id   Int  Auto_increment  NOT NULL ,
        role_nom  Varchar (50) NOT NULL ,
        role_role Varchar (50) NOT NULL
	,CONSTRAINT Roles_PK PRIMARY KEY (role_id)
)ENGINE=InnoDB;

--
-- Contenu de la table `roles`
--
INSERT INTO `roles` (`roles_id`, `role_nom`, `role_role`) VALUES
(1, 'Administrateur', 'admin'),
(2, 'Membre', 'member'),
(3, 'Responsable', 'responsable');

#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
        user_id        Int  Auto_increment  NOT NULL ,
        user_nom       Varchar (50) NOT NULL ,
        user_prenom    Varchar (50) NOT NULL ,
        user_email     Varchar (60) NOT NULL ,
        user_naissance Date NOT NULL ,
        user_adresse   Varchar (100) NOT NULL ,
        user_cp        Varchar (5) NOT NULL ,
        user_ville     Varchar (60) NOT NULL ,
        user_tel       Text NOT NULL ,
        user_login     Varchar (51) NOT NULL ,
        user_mdp       Char (255) NOT NULL ,
        role_id        Int NOT NULL
	,CONSTRAINT Users_PK PRIMARY KEY (user_id)

	,CONSTRAINT Users_Roles_FK FOREIGN KEY (role_id) REFERENCES Roles(role_id)
)ENGINE=InnoDB;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_prenom`, `user_email`, `user_naissance`, `user_adresse`, `user_cp`, `user_ville`, `user_tel`, `user_login`, `user_mdp`, `role_id`) VALUES
(6, 'Doe', 'Jonh', 'jonh.doe@hotmail.com', '1980-02-05', '2 rue des acacias', '92000', 'Montrouge', '0636897845', 'j.doe', '$2y$10$dseQW9Sikq2wQ/2hr4pSIuhJoFPR5pyDtSdUIpmIVDrWKQgYrrd16', 3),
(7, 'Toto', 'Juju', 'jujutoto@gmail.com', '2006-05-13', '12 rue de la mer', '35120', 'Cherrueix', '0603802235', 'j.toto', '$2y$10$wawy60xR4FrG7qyNFGEzneO9ftKFMpmUIRJyWcD3y2ncyotdD/JYi', 2),
(13, 'Laurens', 'Vincent', 'vincentf.laurens@free.fr', '2001-08-13', '1 sentier du clos aux renards', '92350', 'Le plessis robinson', '0651187052', 'v.laurens', '$2y$10$Y7/cK4VKn4mFkuRjQx/9aunj0chb4rSrIFtk5Ul.2qW/ROzrac/Tu', 1),
(21, 'Larrat', 'Jean', 'jean.larrat@gmail.com', '1945-04-05', 'Rue de la paix', '75016', 'Paris', '0146612026', 'j.larrat', '$2y$10$J2yvcmtAuHRWeTEPolleR.sL6t4PUAqZ0BF6yxLcRVKb9E9g3zX9G', 2),
(22, 'Collette', 'Guy', 'guycollette@orange.fr', '1933-05-12', '2 rue de l''Ã©conomie', '59000', 'Valenciennes', '0658974563', 'g.collette', '$2y$10$kYXlPZARPcKFwxMXxKMbN..5vIDd7XrzDhLJWGfkivFEoJ37Gb43a', 2),
(24, 'Dupont', 'Nicolas', 'nicolas.dupont@gmail.com', '2000-02-14', '1 sentier dupont', '92320', 'Chatillon', '0146612026', 'n.dupont', '$2y$10$xCR2iz63aE/bT6Os2tBZR.QwyiF0kbXpMPApThPnxq7FI3AwK3lgG', 2);

#------------------------------------------------------------
# Table: Clubs
#------------------------------------------------------------

CREATE TABLE Clubs(
        club_id      Int  Auto_increment  NOT NULL ,
        club_nom     Varchar (100) NOT NULL ,
        club_adresse Varchar (100) NOT NULL ,
        club_cp      Varchar (5) NOT NULL ,
        club_ville   Varchar (100) NOT NULL ,
        club_tel     Text NOT NULL ,
        club_email   Varchar (60) NOT NULL
	,CONSTRAINT Clubs_PK PRIMARY KEY (club_id)
)ENGINE=InnoDB;
--
-- Contenu de la table `clubs`
--

INSERT INTO `clubs` (`club_id`, `club_nom`, `club_adresse`, `club_cp`, `club_ville`, `club_tel`, `club_email`) VALUES
(16, 'PRVB ', 'Place woking', '92350', 'Le plessis robinson', '0142356989', 'prvb@gmail'),
(17, 'TCPR', 'Parc des sports', '92350', 'Le plessis robinson', '0145897563', 'tcpr@gmail.com'),
(18, 'Boxe', '1 rue de la boxe ', '92350', 'Le plessis robinson', '0299756989', 'boxe@gmail.com'),
(19, 'Ping Pong', '1 rue du ping pong', '92350', 'Le plessis robinson', '0256878569', 'pingpong@gmail.com'),
(20, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(21, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(22, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(23, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(24, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(25, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(26, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(27, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(28, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(29, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(30, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(31, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(32, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299489789', 'cherrueix@wanadoo.fr'),
(42, 'Test', 'Test', '56000', 'Test', '0256785232', 'email@email.fr'),
(43, 'Test', 'Test', '92350', 'Test', '2996523', 'email@email.fr'),
(44, 'Test', 'Test', '92350', 'Test', '2996523', 'email@email.fr'),
(45, 'Test', 'Test', '92350', 'Test', '2996523', 'email@email.fr'),
(46, 'Test', 'Test', '92350', 'Test', '2996523', 'email@email.fr'),
(54, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(55, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(56, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(57, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(58, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(59, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(61, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(62, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(63, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(64, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(65, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(66, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(67, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(68, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(69, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(70, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com'),
(71, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '299784562', 'cherrueix@email.com');


#------------------------------------------------------------
# Table: Ligues
#------------------------------------------------------------

CREATE TABLE Ligues(
        ligue_id      Int  Auto_increment  NOT NULL ,
        ligue_nom     Varchar (70) NOT NULL ,
        ligue_email   Varchar (60) NOT NULL ,
        ligue_tel     Text NOT NULL ,
        ligue_cp      Varchar (5) NOT NULL ,
        ligue_ville   Varchar (100) NOT NULL ,
        ligue_adresse Varchar (100) NOT NULL
	,CONSTRAINT Ligues_PK PRIMARY KEY (ligue_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_sport
#------------------------------------------------------------

CREATE TABLE type_sport(
        id_sport  Int  Auto_increment  NOT NULL ,
        sport_nom Varchar (100) NOT NULL
	,CONSTRAINT type_sport_PK PRIMARY KEY (id_sport)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Articles
#------------------------------------------------------------

CREATE TABLE Articles(
        id                    Int  Auto_increment  NOT NULL ,
        titre                 Varchar (255) NOT NULL ,
        contenu               Text NOT NULL ,
        date_time_publication Datetime NOT NULL ,
        date_time_edition     Datetime NOT NULL
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Adherer
#------------------------------------------------------------

CREATE TABLE Adherer(
        club_id Int NOT NULL ,
        user_id Int NOT NULL ,
        Licence Varchar (10) NOT NULL
	,CONSTRAINT Adherer_PK PRIMARY KEY (club_id,user_id)

	,CONSTRAINT Adherer_Clubs_FK FOREIGN KEY (club_id) REFERENCES Clubs(club_id)
	,CONSTRAINT Adherer_Users0_FK FOREIGN KEY (user_id) REFERENCES Users(user_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: faire partie
#------------------------------------------------------------

CREATE TABLE faire_partie(
        ligue_id Int NOT NULL ,
        club_id  Int NOT NULL
	,CONSTRAINT faire_partie_PK PRIMARY KEY (ligue_id,club_id)

	,CONSTRAINT faire_partie_Ligues_FK FOREIGN KEY (ligue_id) REFERENCES Ligues(ligue_id)
	,CONSTRAINT faire_partie_Clubs0_FK FOREIGN KEY (club_id) REFERENCES Clubs(club_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: pratique
#------------------------------------------------------------

CREATE TABLE pratique(
        id_sport Int NOT NULL ,
        club_id  Int NOT NULL
	,CONSTRAINT pratique_PK PRIMARY KEY (id_sport,club_id)

	,CONSTRAINT pratique_type_sport_FK FOREIGN KEY (id_sport) REFERENCES type_sport(id_sport)
	,CONSTRAINT pratique_Clubs0_FK FOREIGN KEY (club_id) REFERENCES Clubs(club_id)
)ENGINE=InnoDB;

