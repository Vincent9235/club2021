<?php
require('inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page index.php
if (!isset($_SESSION['auth'])){
    header('Location:index.php');exit;
}
$req = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
$req->execute(array($_SESSION['auth']->user_id));
$user = $req->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <h2>Profil de <?php echo($_SESSION['auth']->user_prenom.' '.$_SESSION['auth']->user_nom); ?></h2>
    <br /><br />
    Nom: <?= $user['user_nom']; ?>
    <br />
    Prenom: <?= $user['user_prenom']; ?>
    <br />
    Mail: <?= $user['user_email']; ?>
    <br>
    Adresse: <?= $user['user_adresse']; ?>
    <br>
    Ville: <?= $user['user_ville']; ?>
    <br>
    Tel: <?= $user['user_tel']; ?>
    <?php
    if (isset($user['user_id']) and $user['user_id']==$user['user_id']) :
    ?>
        <br />
        <a href="modif_profil.php">Editer mon profil</a>
        <a href="logout.php">Se déconnecter</a>
    <?php
    endif
    ?>
</body>