<?php
require('../inc/header.php');
if (!isset($_SESSION['auth'])) {
    header('Location:../connexion.php');
    exit;
}
if ($_SESSION['auth']->role_role == 'member') {
    header('Location:../article/actualite.php');
    exit;
}
?>
<div class="txt-center">
    <div class="content1col"></div>
    <h1 class="h1"><strong>Ajouter une ligue</h1>
    <form class="form--m center" id="insert_ligue" name="insert_ligue" action="" method="POST">
        <h3>Nom de la ligue</h3>
        <input name="ligue_name" type="text" value="" placeholder="Nom de la ligue" required />
        <h3>Adresse de la ligue</h3>
        <input name="ligue_adr" type="text" value="" placeholder="Adresse de la  ligue" required />
        <br>
        <h3>Code Postal de la ligue</h3>
        <input id="ligue_cp" name="ligue_cp" type="text" value="" placeholder="Code postal de la ligue" required maxlength="5" />
        <br>
        <h3>Ville de la ligue</h3>
        <input id="ligue_ville" name="ligue_ville" type="text" value="" placeholder="Ville de la ligue" required />
        <h3>Téléphone de la ligue</h3>
        <input id="ligue_tel" name="ligue_tel" type="text" value="" placeholder="Téléphone de la ligue" required maxlength="10" />
        <br>
        <h3>Email de la ligue</h3>
        <input name="ligue_email" id="ligue_email" type="email" value="" placeholder="Email de la ligue" required />
        <br>
        
        <br>
        <a class="btn--cancel" href="ligue.php">Annuler</a>
        <input class="btn--custom" id="add_ligue" name="add_ligue" type="submit" value="Ajouter la ligue">

        <?php
        if (isset($_POST['ligue_name']) && isset($_POST['ligue_adr']) && isset($_POST['ligue_cp']) && isset($_POST['ligue_tel']) && isset($_POST['ligue_email']) && isset($_POST['ligue_ville']) && isset($_POST['add_ligue'])) {
            //Vérification du POST de l'email et de son format valide
            if (isset($_POST['ligue_email'])) {
                $email = $_POST['ligue_email'];
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    //Le script est exécuté
                } else {
                    //Erreur dans la saisie de l'email fin du script
                    echo ("<div class='error-msg'><i class='fa fa-times-circle'></i> Le format de l'adresse mail saisi est invalide</div>");
                    exit();
                }
            }
            $req = $pdo->prepare('INSERT INTO ligues (ligue_nom, ligue_adresse, ligue_cp, ligue_ville, ligue_tel,ligue_email) 
    VALUES(:ligue_name,:ligue_adr,:ligue_cp,:ligue_ville,:ligue_tel,:ligue_email)');
            /* methode execute() de PDO pour faire correspondre les valeurs saisies
    avec les les parametres de la table*/
            $req->execute(array(
                ':ligue_name' => $_POST['ligue_name'],
                ':ligue_adr' => $_POST['ligue_adr'],
                ':ligue_cp' => $_POST['ligue_cp'],
                ':ligue_ville' => $_POST['ligue_ville'],
                ':ligue_tel' => $_POST['ligue_tel'],
                ':ligue_email' => $_POST['ligue_email']
            ));
            echo ("<div class='success-msg'> La ligue a bien été ajoutée</div>");
        }
        ?>
    </form>
    </body>
    </html>