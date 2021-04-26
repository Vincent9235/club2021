<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])) {
    header('Location:../connexion.php');
    exit;
}
//Si l'utilisateur est un membre, redirection à la page actualite.php
if ($_SESSION['auth']->role_role == 'member') {
    header('Location:../article/actualite.php');exit;
}
/*******************REQUETE SQL*******************/
$req=$pdo->prepare('DELETE FROM users WHERE user_id=:num');
$req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
$executeIsOK = $req->execute();
if($executeIsOK){
$message="<strong><div class='container'><div class='txt-center'><div class='success-msg'><i class='fa fa-check'></i> L'utilisateur a bien été supprimé</div></div></div>";
}
else{
$message="<div class='container'><div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> La suppression a échouée</div></div></div>";
}
header("refresh:3;url=membres.php");
echo $message;
echo "<div class='txt-center'>Cliquez <a href='membres.php'>ici</a> pour revenir à la page membre.</div>";
?>