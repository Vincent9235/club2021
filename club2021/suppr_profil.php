<?php
    require('inc/header.php');
	//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
	if (!isset($_SESSION['auth'])){
		header('Location:connexion.php');exit;
	}


    if(isset($_SESSION['auth']->user_id)){
        $suppr_user = $pdo->prepare('DELETE FROM Users WHERE user_id = ?');
        $suppr_user->execute(array($_SESSION['auth']->user_id));
        session_destroy(); //Fermeture de la session
        header('Location: index.php');
    }
?>