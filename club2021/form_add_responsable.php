<?php
require('inc/header.php');
if (!isset($_SESSION['auth'])){
    header('Location:connexion.php');exit;
}
if ($_SESSION['auth']->role_role == 'member') {
    header('Location:article/actualite.php');
}
?>
<!DOCTYPE html><!-- Doctype HTML 5-->
<html lang="fr">
<!--Form ajout sport--->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un responsable</title>
    <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>
<form id="insert_responsables" name="insert_responsables" action="" method="POST">
    <h3>Nom du responsable</h3>
    <input name="responsables_name" type="text" value="" placeholder="Nom du responsable" required />
    <h3>Prénom du responsable</h3>
    <input name="responsables_prenom" type="text" value="" placeholder="Prénom du responsable" required />
    <br>
    <h3>Club du responsable</h3>
    <input id="responsables_club" name="responsables_club" type="text" value="" placeholder="Club du responsable" required />
    <br>
    <h3>Téléphone du responsable</h3>
    <input id="responsables_tel" name="responsables_tel" type="text" value="" placeholder="Téléphone du responsable" required maxlength="10" />
    <br>
    <h3>Email du responsable</h3>
    <input name="responsables_email" id="responsables_email" type="email" value="@" placeholder="Email du responsable" required />
    <br>
    <h3>Mot de passe</h3>
    <input name="responsables_password" type="password" value="" placeholder="Mot de passe du responsable" required maxlength="50" />
    <br>
    <input id="add_responsables" name="add_responsables" type="submit" value="Ajouter le responsable">
</form>
<?php
if (isset($_POST['responsables_name']) && isset($_POST['responsables_prenom']) && isset($_POST['responsables_club']) && isset($_POST['responsables_tel']) && isset($_POST['responsables_email']) && isset($_POST['responsables_password']) && isset($_POST['add_responsables'])) {
    //Vérification du POST de l'email et de son format valide
    if (isset($_POST['responsables_email'])) {
        $email = $_POST['responsables_email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Le script est exécuté
        } else {
            //Erreur dans la saisie de l'email fin du script
            echo ("Le format de l'adresse mail saisi est invalide");
            exit();
        }
        require('inc/db.php');
        //On vérifie que l'email saisie n'est pas déjà utilisé. 
        $req = $pdo->prepare('SELECT rp_id from responsables WHERE rp_email= ?');
        $req->execute([$_POST['responsables_email']]);
        $verif_email = $req->fetch();
        if ($verif_email) {
            echo ("<strong>Cet email est déjà utilisé pour un autre compte.");
            die();
        }
    }
    // Hachage du mot de passe
    $pass_hache = password_hash($_POST['responsables_password'], PASSWORD_DEFAULT);
    //Création du login du responsable avec les informations postées précedemment
    if (isset($_POST['responsables_prenom'])) {
        $substr = substr($_POST['responsables_prenom'], 0, 1);
        $nom = $_POST['responsables_name'];
        $login1 = strtolower($substr . "." . $nom);
    }

?>
    <!--Champ login masqué (type="hidden") permettant de récuperer le login crée précedemment et de l'insérer en base-->
    <input id="responsables_login" name="responsables_login" type="hidden" value="<?= $login1 ?>" placeholder="<?= $login1 ?>" required>
<?php
    $req = $pdo->prepare('INSERT INTO responsables (rp_nom, rp_prenom,rp_email, rp_club, rp_tel,rp_login, rp_mdp) 
    VALUES(:responsables_name,:responsables_prenom,:responsables_email,:responsables_club,:responsables_tel,:responsables_login,:responsables_password)');

    $req->execute(array(
        ':responsables_name' => $_POST['responsables_name'],
        ':responsables_prenom' => $_POST['responsables_prenom'],
        ':responsables_email' => $_POST['responsables_email'],
        ':responsables_club' => $_POST['responsables_club'],
        ':responsables_tel' => $_POST['responsables_tel'],
        ':responsables_login' => $login1,
        ':responsables_password' => $pass_hache
    ));
    echo ('Le responsable a bien été ajouté. <br><strong>Son login est:' . $login1);
}
?>