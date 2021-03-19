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

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter un club</title>
        <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    </head>
<form id="insert_club" name="insert_club" action="" method="POST">
    <h3>Nom du club</h3>
    <input name="club_name" type="text" value="" placeholder="Nom du club" required />
    <h3>Adresse du club</h3>
    <input name="club_adr" type="text" value="" placeholder="Adresse du club" required />
    <br>
    <h3>Code Postal du club</h3>
    <input id="club_cp" name="club_cp" type="number" value="" placeholder="Code postal du club" required maxlength="5"/>
    <br>
    <h3>Téléphone du club</h3>
    <input id="club_tel" name="club_tel" type="text" value="" placeholder="Votre téléphone" required maxlength="10" />
    <br>
    <h3>Email du club</h3>
    <input name="club_email" id="club_email" type="email" value="@" placeholder="Email du club" required />
    <br>
    <h3>Ville du club</h3>
    <input id="club_ville" name="club_ville" type="text" value="" placeholder="Ville du club" required />
    <br>
        <input id="add_club" name="add_club" type="submit" value="Ajouter le club">
</form>
<?php
if (isset($_POST['club_name']) && isset($_POST['club_adr']) && isset($_POST['club_cp']) && isset($_POST['club_tel']) && isset($_POST['club_email']) && isset($_POST['club_ville']) && isset($_POST['add_club'])) {
    //Vérification du POST de l'email et de son format valide
    if (isset($_POST['club_email'])) {
        $email = $_POST['club_email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Le script est exécuté
        } else {
            //Erreur dans la saisie de l'email fin du script
            echo ("Le format de l'adresse mail saisi est invalide");
            exit();
        }
    }
    require ('inc/db.php');
    $req = $pdo->prepare('INSERT INTO clubs (club_nom, club_adresse, club_cp, club_ville, club_tel,club_email) 
    VALUES(:club_name,:club_adr,:club_cp,:club_ville,:club_tel,:club_email)');
                 /* methode execute() de PDO pour faire correspondre les valeurs saisies
    avec les les parametres de la table*/
                 $req->execute(array(
                     ':club_name' => $_POST['club_name'],
                     ':club_adr' => $_POST['club_adr'],
                     ':club_cp' => $_POST['club_cp'],
                     ':club_ville' => $_POST['club_ville'],
                     ':club_tel' => $_POST['club_tel'],
                     ':club_email' => $_POST['club_email']
                 ));
                 echo('Le club a bien été ajouté');
}
?>