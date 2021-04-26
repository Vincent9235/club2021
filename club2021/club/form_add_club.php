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
?>
<div class="txt-center">
<div class="content1col"></div>
<h1 class="h1"><strong>Ajouter un club </h1>
<form class="form--m center" id="insert_club" name="insert_club" action="" method="POST">
    <h3>Nom du club</h3>
    <input name="club_name" type="text" value="" placeholder="Nom du club" required />
    <h3>Adresse du club</h3>
    <input name="club_adr" type="text" value="" placeholder="Adresse du club" required />
    <br>
    <h3>Code Postal du club</h3>
    <input id="club_cp" name="club_cp" type="text" value="" placeholder="Code postal du club" required maxlength="5" />
    <br>
    <h3>Téléphone du club</h3>
    <input id="club_tel" name="club_tel" type="text" value="" placeholder="Téléphone du club" required maxlength="10" />
    <br>
    <h3>Email du club</h3>
    <input name="club_email" id="club_email" type="email" value="@" placeholder="Email du club" required />
    <br>
    <h3>Ville du club</h3>
    <input id="club_ville" name="club_ville" type="text" value="" placeholder="Ville du club" required />
    <br>
    <a class="btn--cancel" href="club.php">Annuler</a>
    <input class="btn--custom" id="add_club" name="add_club" type="submit" value="Ajouter le club">

<?php
if (isset($_POST['club_name']) && isset($_POST['club_adr']) && isset($_POST['club_cp']) && isset($_POST['club_tel']) && isset($_POST['club_email']) && isset($_POST['club_ville']) && isset($_POST['add_club'])) {
    //Vérification du POST de l'email et de son format valide
    if (isset($_POST['club_email'])) {
        $email = $_POST['club_email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Le script est exécuté
        } else {
            //Erreur dans la saisie de l'email fin du script
            echo ("<div class='error-msg'>Le format de l'adresse mail saisi est invalide</div>");
            exit();
        }
    }
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
    echo("<div class='txt-center'><div class='success-msg'><i class='fa fa-check'></i> Le club a bien été ajouté </div></div>");
    echo 'Cliquez <a href="club.php">ici</a> pour revenir à la page club.';
}
?>
</form>
</div>
</div>
</body>
</html>