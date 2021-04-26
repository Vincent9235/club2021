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
<body>
<div class="txt-center">
    <h1 class="h1">Gestion des utilisateurs</h1>
    <!--Début du formulaire------>
    <form class="form form--m center" method="post" action="">

        <h2><strong>Ajouter un utilisateur</h2>
        <fieldset>
            <legend>Identification</legend>
            <div>
                <label class="size-s" for="user_nom">Nom:</label>
                <input id="user_nom" name="user_nom" type="text" value="" placeholder="Nom de l'utilisateur" required>
            </div>
            <br>
            <div>
                <label class="size-s" for="user_prenom">Prénom :</label>
                <input id="user_prenom" name="user_prenom" type="text" placeholder="Prénom de l'utilisateur" required>
            </div>
            <div>
                <label class="size-s" for="password">Mot de passe:</label>
                <input id="password" name="password" type="password" placeholder="Mot de passe de l'utilisateur" required>
            </div>
            <br>
            <div>
                <label class="size-s" for="user_email">Email :</label>
                <input id="user_email" name="user_email" type="email" placeholder="Email de l'utilisateur" required>
            </div>
            <div>
                <label class="size-s" for="user_adresse">Adresse:</label>
                <input id="user_adresse" name="user_adresse" type="text" placeholder="Adresse de l'utilisateur" required>
            </div>

            <div>
                <label class="size-s" for="user_cp">Code Postal:</label>
                <input id="user_cp" name="user_cp" type="text" placeholder="Code postal de l'utilisateur" maxlenght="5" required>
            </div>
            <div>
                <label class="size-s" for="user_cp">Ville:</label>
                <input id="user_ville" name="user_ville" type="text" placeholder="Ville de l'utilisateur" required>
            </div>

            <div>
                <label class="size-s" for="user_naissance">Date de naissance:</label>
                <input id="user_naissance" name="user_naissance" type="date" placeholder="Date de naissance de l'utilisateur" required>
            </div>

            <div>
                <label class="size-s" for="user_tel">Téléphone:</label>
                <input id="user_tel" name="user_tel" type="text" placeholder="Téléphone de l'utilisateur" required>
            </div>
        </fieldset>
        <fieldset>
            <legend>Privilèges</legend>
            <div>
                <label class="size-s" for="role_id">Rôle :</label>
                
                <select name="role_id" id="role_id" required>
                <span class="icon"><i class="fa fa-arrow-down">
                    <option value="" selected disabled hidden>Sélectionnez</option>
                    <OPTION value="1">Administrateur</option>
                    <OPTION value="2">Membre</option>
                    <OPTION value="3">Responsable</option>

                </select>
                </i></span>
            </div>
        </fieldset>

        <div class="txt-center">
            <a class="btn--cancel" href="membres.php">Annuler</a>
            <input class="btn--custom" type="submit" value="Ajouter l'utilisateur" id="add_user" name="add_user" />
        </div>
        <?php
        if (isset($_POST['add_user']) && ($_POST['user_nom']) && ($_POST['user_prenom']) && ($_POST['user_tel']) && ($_POST['user_cp']) && ($_POST['user_naissance']) && ($_POST['user_adresse']) && ($_POST['user_ville']) && ($_POST['password'])) {
            $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT); //mot de passe haché
            //Création du login
            $substr = substr($_POST['user_prenom'], 0, 1);
            $nom = $_POST['user_nom'];
            $login1 = strtolower($substr . "." . $nom);

            //REQUETE SQL POUR INSERER EN BASE
            $req = $pdo->prepare('INSERT INTO Users (user_login, user_nom,user_prenom, user_mdp, user_email, user_naissance, user_adresse, user_tel, user_cp, user_ville, role_id) 
                        VALUES(:login1,:nom,:prenom,:confirm_password,:email,:date_naissance, :adresse, :tel, :cp, :ville, :role_id)');
            /* methode execute() de PDO pour faire correspondre les valeurs saisies
                        avec les les parametres de la table*/
            $executeIsOK = $req->execute(array(
                ':prenom' => $_POST['user_prenom'],
                ':nom' => $_POST['user_nom'],
                ':login1' => $login1,
                ':confirm_password' => $pass_hache,
                ':email' => $_POST['user_email'],
                ':date_naissance' => $_POST['user_naissance'],
                ':adresse' => $_POST['user_adresse'],
                ':tel' => $_POST['user_tel'],
                ':cp' => $_POST['user_cp'],
                ':ville' => $_POST['user_ville'],
                ':role_id' => $_POST['role_id']
            ));
            if ($executeIsOK) {
                header("refresh:3;url=membres.php");
                echo ("<div class='txt-center'><div class='success-msg'><i class='fa fa-check'></i> L'utilisateur a bien été ajouté</div></div>");
                echo 'Les données vont être rafraichies dans 3 secondes. Sinon cliquez <a href="membres.php">ici</a>.';
            } else {
                echo ("<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> L'ajout a échoué</div></div>");
            }
        }
        ?>
    </form>
</div>
</body>
</html>