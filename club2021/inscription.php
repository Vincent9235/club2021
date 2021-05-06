<?php
require('inc/header.php');
//Si l'utilisateur est connecté alors, il ne peut pas accéder au formulaire d'inscription
if (isset($_SESSION['auth'])) {
    header('Location:article/actualite.php');
    exit;
}
?>
<div class="txt-center">
<h1 class="h1">Inscription</h1>
<div class="content1col"></div>
<!--Formulaire d'inscription----------->
<form class="form form--m center" id="inscription" name="inscription" action="" method="POST">
    <h3>Nom</h3>
    <input name="nom" type="text" size="" value="<?php if (isset($_POST['nom'])) {
                                                        echo $_POST['nom'];
                                                    } ?>" placeholder="Votre nom" required maxlength="50" />
    <h3>Prénom</h3>
    <input name="prenom" type="text" size="" value="<?php if (isset($_POST['prenom'])) {
                                                                                echo $_POST['prenom'];
                                                                            } ?>" placeholder="Votre prénom" required maxlength="50" />
    <h3>Email</h3>
    <input name="email" type="email" value="<?php if (isset($_POST['email'])) {
                                                                                echo $_POST['email'];
                                                                            } ?>" placeholder="Votre email" required />
    <h3>Date de naissance</h3>
    <input name="date_naissance" type="date" value="<?php if (isset($_POST['date_naissance'])) { echo $_POST['date_naissance']; } ?>" placeholder="Votre date de naissance" required />
    <br>
    <h3>Mot de passe</h3>
    <input name="password" type="password" value="" placeholder="Votre mot de passe" required maxlength="50" />
    <h3>Confirmation du mot de passe</h3>
    <input name="confirm_password" type="password" value="" placeholder="Confirmez votre mot de passe" required maxlength="50" />
    <br>
    <input name="inscription" type="submit" value="S'inscrire">
</form>
<?php
//Contrôle de la saisie du formulaire (inutile de vérifier les autres champs, required étant atribué à chaque balise html du formulaire.)
if (isset($_POST['inscription']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['date_naissance']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

    //Vérfication de la longueur du nom et du prénom
    $prenomlength = strlen($_POST['prenom']);
    $nomlength = strlen($_POST['nom']);
    if ($prenomlength > 50 or $nomlength > 50) {
        echo ('Votre identité ne doit pas dépasser 50 caractères');
        exit();
    } else {
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //comparaison du mot de passe et de la confirmation
        if ($_POST['password'] <> $_POST['confirm_password']) {
            echo ('<div class="error-msg">Le mot de passe saisi et sa confirmation, ne correspondent pas</div>');
        } else {
            //Création du login de l'adhérent avec les informations postées précedemment
            if (isset($_POST['prenom'])) {
                $substr = substr($_POST['prenom'], 0, 1);
                $nom = $_POST['nom'];
                $login1 = strtolower($substr . "." . $nom);
            }
?>
<?php
            //Vérification du POST de l'email et de son format valide
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    //Le script est exécuté
                } else {
                    //Erreur dans la saisie de l'email fin du script
                    echo ("<div class='error-msg><strong>Le format de l'adresse mail saisi est invalide</div>");
                    exit();
                }


                //On vérifie que l'email saisie n'est pas déjà utilisé. 
                $req = $pdo->prepare('SELECT user_id from Users WHERE user_email= ?');
                $req->execute([$_POST['email']]);
                $verif_email = $req->fetch();
                if ($verif_email) {
                    echo ("<div class='error-msg><strong>Cet email est déjà utilisé pour un autre compte.</strong></div>");
                    die();
                }
                //Création de la date à insérer afin de laisser le format FR dans le datetimepicker
                //$date_naissance = strftime('%Y/%m/%d', strtotime($_POST['date_naissance']));
                //Envoi des informations dans la bdd

                $req = $pdo->prepare('INSERT INTO Users (user_nom,user_prenom, user_mdp, user_email, user_naissance,role_id) 
   VALUES(:nom,:prenom,:confirm_password,:email,:date_naissance,:role_id)');
                /* methode execute() de PDO pour faire correspondre les valeurs saisies
   avec les les parametres de la table*/
                $req->execute(array(
                    ':prenom' => $_POST['prenom'],
                    ':nom' => $_POST['nom'],
                    ':confirm_password' => $pass_hache,
                    ':email' => $email,
                    ':date_naissance' => $_POST['date_naissance'], //$_POST['date_naissance'],
                    ':role_id' => "2"
                ));
                $query = "SELECT user_id,  user_prenom, user_nom, user_email, user_naissance,user_adresse,user_tel,user_ville,user_cp, role_nom, role_role FROM users 
                LEFT JOIN roles ON roles_id=role_id
                WHERE user_email=:email";
                $prepare = $pdo->prepare($query);
                $prepare->bindValue('email', $email, PDO::PARAM_STR);
                $prepare->execute();
                $user = $prepare->fetch();
                $_SESSION['auth'] = $user;
                echo ("<div class='success-msg>Vous allez être redigiré afin de compléter vos informations<strong><br>Votre login est: " . $login1 . "</div>");
                header("Location: remplir_info.php"); //redirection vers une page permettant à l'utilisateur de renseigner davantage d'informations sur lui.
            }
        } //Fin du if(isset($_POST['inscription']))
    } //Fin du if(isset($_POST['email]))
}
?>
</div>
</body>

<!--DATETIMEPICKER
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
<script src="js/jquery.js"></script>
<script src="js/build/jquery.datetimepicker.full.min.js"></script>
<script>
    jQuery('#datetimepicker').datetimepicker();
    jQuery.datetimepicker.setLocale('fr');
    jQuery('#datetimepicker').datetimepicker({
        i18n: {
            fr: {
                months: [
                    'Janvier', 'Février', 'Mars', 'Avril',
                    'Mai', 'Juin', 'Juillet', 'Août',
                    'Septembre', 'Octobre', 'Novembre', 'Décembre',
                ],
                dayOfWeek: [
                    "Lu.", "Mo", "Di", "Mi",
                    "Do", "Fr", "Sa.",
                ]
            }
        },
        dayOfWeekStart:1,
        timepicker: false,
        yearStart:'1940',
        yearEnd:'2020',
        minDate:'1940/01/02',
        maxDate:'=1970/01/02',//today is maximum date calendar
        format:'d/m/Y'
        //format: 'Y.m.d'
    });
</script>---->

</html>
<!--Force du mot de passe, mdp oublié-->