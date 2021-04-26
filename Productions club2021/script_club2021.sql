#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
#------------------------------------------------------------
# Table: Roles
#------------------------------------------------------------

CREATE TABLE Roles(
        role_id   Int  Auto_increment  NOT NULL ,
        role_nom  Varchar (30) NOT NULL ,
        role_role Varchar (30) NOT NULL
	,CONSTRAINT Roles_PK PRIMARY KEY (role_id)
)ENGINE=InnoDB;
--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role_nom`, `role_role`) VALUES
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
        user_mdp       Char (255) NOT NULL ,
        role_id        Int NOT NULL
	,CONSTRAINT Users_PK PRIMARY KEY (user_id)

	,CONSTRAINT Users_Roles_FK FOREIGN KEY (role_id) REFERENCES Roles(role_id)
)ENGINE=InnoDB;
--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_prenom`, `user_email`, `user_naissance`, `user_adresse`, `user_cp`, `user_ville`, `user_tel`, `user_mdp`, `role_id`) VALUES
(6, 'Doe', 'Jonh', 'jonh.doe@hotmail.com', '1980-02-05', '2 rue des acacias', '92000', 'Montrouge', '0636897845', '$2y$10$dseQW9Sikq2wQ/2hr4pSIuhJoFPR5pyDtSdUIpmIVDrWKQgYrrd16', 3),
(13, 'Laurens', 'Vincent', 'vincentf.laurens@free.fr', '2001-08-13', '1 sentier du clos aux renards', '92350', 'Le plessis robinson', '0651187052', '$2y$10$sgTl5PinnjZRNYf7XBF5e.PTfG0aIf0frpOr8iYJf/P9zRll.dSJe', 1),
(21, 'Larrat', 'Jean', 'jean.larrat@gmail.com', '1945-04-05', 'Rue de la paix', '75016', 'Paris', '0146612026', '$2y$10$J2yvcmtAuHRWeTEPolleR.sL6t4PUAqZ0BF6yxLcRVKb9E9g3zX9G', 2),
(22, 'Collette', 'Guy', 'guycollette@orange.fr', '1933-05-12', '2 rue de l''Ã©conomie', '59000', 'Valenciennes', '0658974563', '$2y$10$kYXlPZARPcKFwxMXxKMbN..5vIDd7XrzDhLJWGfkivFEoJ37Gb43a', 2),
(24, 'Dupont', 'Nicolas', 'nicolas.dupont@gmail.com', '2000-02-14', '1 sentier dupont', '92320', 'Chatillon', '0146612026', '$2y$10$xCR2iz63aE/bT6Os2tBZR.QwyiF0kbXpMPApThPnxq7FI3AwK3lgG', 2),
(46, 'Admin', 'Admin', 'admin@admin.com', '2001-08-13', '1 rue de l''admin', '92120', 'Montrouge', '0651187052', '$2y$10$R56bTeoLQoFwXvE.PJcWgugzYcXTJl9KX3Y8M.vNVtGzzuhS3Tn7S', 1),
(52, 'Laurens', 'HervÃ©', 'herher@free.fr', '1965-03-19', '??', '92350', 'Le plessis robinson', '0603802236', '$2y$10$LX9iOO/r.ueJjlIJicxtA.QGeCIpLZ6D425Gm.KBS5X47P.d0vLOy', 1);


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
(54, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299784562', 'cherrueix@email.com'),
(55, 'Cherrueix', '12 rue de saint pierre', '35120', 'Cherrueix', '0299784562', 'cherrueix@email.com'),
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

--
-- Contenu de la table `ligues`
--

INSERT INTO `ligues` (`ligue_id`, `ligue_nom`, `ligue_email`, `ligue_tel`, `ligue_cp`, `ligue_ville`, `ligue_adresse`) VALUES
(2, 'FFT', 'fft@gmail.com', '0145789563', '75016', 'Paris', '1 rue du tennis '),
(3, 'Boxe', 'boxe@gmail.com', '0452315647', '75000', 'Paris', '1 rue de la boxe');

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
        date_time_edition     Datetime NOT NULL ,
        auteur                Varchar (100) NOT NULL
	,CONSTRAINT Articles_PK PRIMARY KEY (id)
)ENGINE=InnoDB;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `contenu`, `date_time_publication`, `date_time_edition`, `auteur`) VALUES
(6, 'A FAIRE POUR AMELIORER', '-Il faudra rajouter une colonne Categorie et ensuite afficher les articles en fonction du sport de l''utilisateur', '2021-01-28 12:16:12', '2021-04-26 09:56:27', ''),
(10, 'Nouvelles informations pour le club', '[b]Enfin un peu de CSS![/b]', '2021-03-24 19:43:53', '0000-00-00 00:00:00', ''),
(12, 'Article du 24/04/2021', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque \r\neleifend placerat ligula nec aliquam. Sed laoreet auctor tellus, nec \r\nconsequat est euismod nec. Donec venenatis, erat sit amet ornare \r\ntristique, sapien turpis fringilla dolor, id tincidunt erat nisl id \r\nmagna. Mauris vehicula libero vel quam eleifend molestie. Donec \r\ntincidunt arcu quis luctus tristique. Pellentesque aliquet urna \r\nconsectetur, imperdiet risus vitae, eleifend lacus. Maecenas sit amet \r\nrisus ac mi elementum sagittis eu nec dui. Duis aliquam lectus non metus\r\n sodales, sit amet viverra libero consectetur. Donec lacinia mauris \r\nelit, ac molestie tellus congue sit amet. Nullam egestas elementum \r\ncondimentum. Aenean lacinia urna quis metus consequat vulputate. Donec \r\ncursus molestie quam, a sodales tortor porta nec. Praesent eros ex, \r\negestas vitae dolor sed, viverra scelerisque turpis. Integer tincidunt \r\nquam at ligula vestibulum eleifend. Integer laoreet lacus sit amet lorem\r\n eleifend pretium. Suspendisse ut leo arcu.\r\n\r\nCras euismod metus vel turpis vestibulum, sed posuere risus tempus. \r\nNullam semper sit amet leo in posuere. Ut luctus accumsan condimentum. \r\nAliquam erat volutpat. Maecenas imperdiet eleifend scelerisque. \r\nVestibulum efficitur eget dui nec dictum. Vivamus et pellentesque nisl, \r\ninterdum iaculis mi. Duis sit amet facilisis eros. Maecenas mollis ante \r\nsit amet neque hendrerit placerat. Pellentesque habitant morbi tristique\r\n senectus et netus et malesuada fames ac turpis egestas.\r\n\r\nNunc vitae auctor lorem. Donec quis libero ut sapien consequat ultrices \r\nin id lacus. Sed suscipit nulla et lacus semper tincidunt. Maecenas \r\nvarius neque ut sapien consectetur varius vel vel elit. Phasellus sed \r\nporta sapien. Curabitur lobortis lorem sed egestas sagittis. Vestibulum \r\nac efficitur tellus. Nulla non nibh iaculis, malesuada odio sed, rutrum \r\nante.', '2021-04-24 11:46:39', '2021-04-24 11:51:41', ''),
(13, 'Maison des ligues', '[center][b]Suspendisse et nisi eleifend, ornare justo rutrum, faucibus magna. \r\nInteger pharetra ut ipsum quis venenatis. Sed aliquam vestibulum eros \r\nnon mollis. Fusce mattis, mauris condimentum placerat laoreet, nisi nisi\r\n laoreet dolor, et dapibus velit purus a enim. Fusce vitae nibh et lorem\r\n pellentesque aliquet in fringilla est. Vivamus justo magna, elementum \r\nnec ligula sit amet, commodo venenatis justo. Aliquam placerat quis leo \r\nluctus gravida. Ut mollis velit vestibulum, dapibus metus nec, \r\npellentesque mi. Mauris consectetur turpis sed urna accumsan, a faucibus\r\n elit venenatis. Suspendisse sit amet nulla in est aliquam maximus. \r\nMaecenas eget bibendum lorem. Sed ornare lorem enim, vel porttitor enim \r\nmattis eu. Curabitur eget tempor orci. Maecenas finibus diam lorem, vel \r\nsagittis urna tempus at. Praesent risus diam, scelerisque ut elit nec, \r\nultricies pretium tortor. Aliquam rutrum eleifend lectus, sed suscipit \r\npurus.\r\n\r\nIn id nisl sagittis, porttitor magna ut, tempor sapien. Cras commodo sem\r\n tortor, at euismod nibh pretium ut. Donec quis mi vitae ipsum efficitur\r\n tempus. Donec sit amet sem lectus. Maecenas fringilla, ipsum sit amet \r\ntincidunt facilisis, dolor turpis ornare turpis, sit amet rhoncus ipsum \r\nlacus non nisl. Phasellus tincidunt nibh quis nisl gravida, in tincidunt\r\n risus venenatis. Praesent ac arcu nec leo finibus rutrum. Orci varius \r\nnatoque penatibus et magnis dis parturient montes, nascetur ridiculus \r\nmus. Proin et libero eu ex molestie efficitur. In quis ante orci. Morbi \r\nullamcorper lorem lorem, vitae finibus neque accumsan vitae. Sed ac \r\nlobortis turpis. Nam sagittis quam a tristique sollicitudin. Vestibulum \r\nplacerat hendrerit neque, nec vulputate nisi tristique eget. Fusce \r\nlobortis ut eros nec posuere.[/b][/center]\r\n', '2021-04-24 11:52:07', '0000-00-00 00:00:00', ''),
(17, 'Article du jour ', '[b]Lorem Ipsum[/b][u][b] is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy\r\n text ever since the 1500s, when an unknown printer took a galley of [/b]\r\n\r\n\r\ntype and scrambled it to make a type specimen book. It has survived not \r\nonly five centuries, but also the lea[/u]p [center][i]into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.[/i][/center]', '2021-04-26 16:37:22', '0000-00-00 00:00:00', 'Vincent Laurens'),
(18, 'Article du jour n2', '[b]Hello\r\n\r\n[/b][i]it[/i]', '2021-04-26 16:43:37', '0000-00-00 00:00:00', 'HervÃ© Laurens');

#------------------------------------------------------------
# Table: Adherer
#------------------------------------------------------------

CREATE TABLE Adherer(
        club_id       Int NOT NULL ,
        user_id       Int NOT NULL ,
        Licence       Varchar (20) NOT NULL ,
        date_adhesion Date NOT NULL
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


SELECT 'Script réalisé';
