<?php
require('inc/header.php');
?>

<body>
    <h1>Connexion</h1>
    <!--Formulaire de connexion----------->
    <form id="connexion" name="connexion" action="" method="POST">
        <h3>Login</h3>
        <input name="login_ad" type="text" value="" placeholder="Votre login" required />
        <h3>Mot de passe</h3>
        <input name="password" type="password" value="" placeholder="Votre mot de passe" required />
        <br>
        <input id="connexion" name="connexion" type="submit" value="Se connecter" />
        <?php
        //Vérification du Login et mot de passe
        if (isset($_POST['login_ad']) and isset($_POST['password'])) {
            if (!empty($_POST['login_ad']) and !empty($_POST['password'])) { //si les champs ne sont pas vides, alors la requête préparée est exécutée. 
                $login = $_POST['login_ad'];

                $req = $pdo->prepare('SELECT user_id,user_login,user_email,user_mdp FROM Users WHERE user_login =:login_ad');
                $req->bindValue('login_ad',$login,PDO::PARAM_STR);
                $req->execute();
                $resultat = $req->fetch();

                if (!$resultat or !password_verify($_POST['password'], $resultat->user_mdp)) { //on utilise la fonction password verify pour faire correspondre le mdp saisi à celui stocké dans la bdd.
                    echo '<br><strong>Identifiant ou Mot De Passe incorrect.<br/>';
                    die();
                } else {
                    $query = "SELECT user_id, user_login, user_prenom, user_nom, user_email, user_naissance,user_adresse,user_tel,user_ville,user_cp, role_nom, role_role FROM users 
            LEFT JOIN roles ON roles_id=role_id
            WHERE user_login=:login";
                    $prepare = $pdo->prepare($query);
                    $prepare->bindValue('login', $login , PDO::PARAM_STR);
                    $prepare->execute();
                    $user = $prepare->fetch();
                    $_SESSION['auth']=$user;
                    /*$_SESSION['id'] = $resultat['user_id'];
                    $_SESSION['login'] = $resultat['user_login'];
                    $_SESSION['mail'] = $resultat['user_email'];*/
                    echo '<br><strong>Vous êtes connecté<br/>';
                    Header('Location:article/actualite.php');
                }

                $req->closeCursor(); //On ferme la connexion à la base 
            }
        }
        ?>
</body>
<!--Stocker INFOS USER DANS UNE VARIABLE VOIR FONCTIONS02.PHP--->

</html>