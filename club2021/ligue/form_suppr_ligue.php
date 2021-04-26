<?php 
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])){
    header('Location:../connexion.php');exit;
 }
 //Si l'utilisateur est un membre, redirection à la page actualite.php
 if ($_SESSION['auth']->role_role == 'member') {
    header('Location:../article/actualite.php');exit;
 }

$req=$pdo->prepare('DELETE FROM ligues WHERE ligue_id=:num');
$req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
$executeIsOK = $req->execute();
if($executeIsOK){
$message="<div class='txt-center'><div class='success-msg'><i class='fa fa-check'></i> La ligue a bien été supprimé</div></div>";
}
else{
$message="<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> La suppression a échouée</div></div>";
}
echo $message;
//header("refresh:3;url=club.php");
header('Location:ligue.php');