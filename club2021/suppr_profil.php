<?php
	//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
	if (!isset($_SESSION['auth'])){
		header('Location:connexion.php');exit;
	}
    require('inc/header.php');

    if(isset($_SESSION['auth']->user_id)){
        $suppr_user = $pdo->prepare('DELETE FROM Users WHERE user_id = ?');
        $suppr_user->execute(array($_SESSION['auth']->user_id));
        header('Location: index.php');
    }
?>