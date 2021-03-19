<?php
require('inc/header.php');
//Si l'utilisateur est connecté alors il ne peut pas accéder au formulaire d'inscription
if (isset($_SESSION['auth'])) {
	header('Location:article/actualite.php');
	exit;
}
?>

<body>
    <!--Formulaire d'inscription----------->
    <h1>Compléments d'inscription de l'adhérent</h1>
    <form id="inscription2" name="inscription2" action="" method="POST">
        <h3>Adresse</h3>
        <input id="adresse" name="adresse" type="text" size="" value="" placeholder="Votre adresse" required maxlength="100" />
        <h3>Ville</h3>
        <input id="ville" name="ville" type="text" value="" placeholder="Votre ville" required maxlength="60" />
        <h3>Code postal</h3>
        <input id="cp" name="cp" type="text" size="" value="" placeholder="Votre code postal" required maxlength="5" />
        <h3>Téléphone</h3>
        <input id="tel" name="tel" type="text" size="" value="" placeholder="Votre téléphone" required maxlength="10" />
        <br>

        <!--Choix du sport---->
        <h3>Votre sport</h3>
        <select name="sport" required>
            <OPTION value="" selected disabled hidden>Choisir votre sport</OPTION>
            <OPTION value="Foot">Foot</OPTION>
            <OPTION value="Tennis">Tennis</OPTION>
            <OPTION value="Handball">Handball</OPTION>
            <OPTION value="Basket">Basket</OPTION>
            <OPTION value="Volley">Volley</OPTION>
            <OPTION value="Badminton">Badminton</OPTION>
            <OPTION value="Natation">Natation</OPTION>
            <OPTION value="Cyclisme">Cyclisme</OPTION>
            <OPTION value="Athletisme">Athlétisme</OPTION>
        </select>

        <!--Choix du club------>
        <select name="club" required>
            <OPTION value="" selected disabled hidden>Choisir votre club</OPTION>
            <OPTION value="OM">Marseille</OPTION>
            <OPTION value="PSG">Paris</OPTION>
            <OPTION value="Montpelier">Montpelier</OPTION>
            <OPTION value="Toulouse">Toulouse</OPTION>
        </select>
        <br>
        <input name="confirm_inscription" type="submit" value="Confirmer votre inscription">
    </form>
    <?php
    //Contrôle de la saisie du formulaire
    if (isset($_POST['confirm_inscription']) && ($_POST['adresse']) && ($_POST['cp']) && ($_POST['tel'])) {
        //Requête permettant d'insérer les utilisateurs dans BDD.  
        $req = $pdo->prepare('UPDATE Users SET user_adresse =:adresse, user_ville=:ville,  user_cp=:cp, user_tel=:tel WHERE user_id=:user_id');
        $req->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
        $req->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
        $req->bindValue(':cp', $_POST['cp'], PDO::PARAM_INT);
        $req->bindValue(':tel', $_POST['tel'], PDO::PARAM_STR);
        $req->bindValue(':user_id', $_SESSION['auth']->user_id, PDO::PARAM_STR);
        $req->execute();
        //var_dump($_SESSION['id']);
        if (isset($_POST['club']) && ($_POST['sport'])) {

            $req = $pdo->prepare('INSERT INTO clubs (club_nom) 
        VALUES(:club)');
            /*methode execute() de PDO pour faire correspondre les valeurs saisies
            avec les les parametres de la table*/
            $req->execute(array(
                ':club' => $_POST['club']
            ));
        }
        echo('Votre inscription a bien été prise en compte. Votre login est: '.$_SESSION['auth']->user_login);
        //header('Location:article/actualite.php');
        //echo('Merci'.$_POST['prenom']." ".$_POST['nom']'votre inscription a bien été prise en compte. Vous allez être redirigé dans 3 secondes sur la page d\accueil');
        //$message = 'Merci '.$_POST['prenom'].' '.$_POST['nom'].' '.'votre inscription a bien été prise en compte. Vous allez être redirigé dans 3 secondes sur la page d\accueil'; 
        //echo($message);
    }
    ?>
    <a href="article/actualite.php">Cliquez ici pour accéder au site de la M2L</a>
</body>

</html>