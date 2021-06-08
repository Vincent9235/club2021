<?php
require('inc/header.php');
?>

<body>
    <div class="txt-center">
        <div class="content1col">
            <h1 class="h1">Connexion</h1>
            <!--Formulaire de connexion----------->
            <form class="form form--m center" id="connexion" name="connexion" action="" method="POST">
                <h3>Login</h3>
                <input name="user_email" type="email" value="" placeholder="Votre email" required />
                <h3>Mot de passe</h3>
                <input name="password" type="password" value="" placeholder="Votre mot de passe" required />
                <br>
                <input id="connexion" name="connexion" type="submit" value="Se connecter" />
                <a href="forgot_password.php">Mot de passe oublié ?</a>
        </div>
        <?php
        //Vérification du Login et mot de passe
        if (isset($_POST['user_email']) and isset($_POST['password'])) {
            if (!empty($_POST['user_email']) and !empty($_POST['password'])) { //si les champs ne sont pas vides, alors la requête préparée est exécutée. 
                $_POST['user_email'];
                $req = $pdo->prepare('SELECT user_id,user_email,user_mdp FROM Users WHERE user_email =:user_email');
                $req->bindValue('user_email', $_POST['user_email'], PDO::PARAM_STR);
                $req->execute();
                $resultat = $req->fetch();

                if (!$resultat or !password_verify($_POST['password'], $resultat->user_mdp)) { //on utilise la fonction password verify pour faire correspondre le mdp saisi à celui stocké dans la bdd.
                    echo "<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> Identifiant ou mot de passe incorrect</div></div>";
                    die();
                } else {
                    //Récupération des informations de session de l'utilisateur
                    $query = "SELECT user_id,  user_prenom, user_nom, user_email, user_naissance,user_adresse,user_tel,user_ville,user_cp, role_nom, role_role FROM users 
            LEFT JOIN roles ON roles_id=role_id
            WHERE user_email=:login";
                    $prepare = $pdo->prepare($query);
                    $prepare->bindValue('login', $_POST['user_email'], PDO::PARAM_STR);
                    $prepare->execute();
                    $user = $prepare->fetch();
                    $_SESSION['auth'] = $user;
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
        
    </div>
    </form>
</body>
</html>