<?php	
    require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])){
	header('Location:../connexion.php');exit;
}
	//Si l'utilisateur est un membre, redirection à la page actualite.php
	if ($_SESSION['auth']->role_role == 'member') {
		
		header('Location:actualite.php');exit;
	}
	if(isset($_GET['id']) AND !empty($_GET['id'])) {
	   $suppr_id = htmlspecialchars($_GET['id']);
	   $suppr = $pdo->prepare('DELETE FROM articles WHERE id = ?');
	   $suppr->execute(array($suppr_id));
	   header('Location: actualite.php');
	}
