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
    <?php
    /*******************REQUETE SQL  *******************/
    $req = $pdo->prepare('SELECT  * FROM users LEFT JOIN roles ON roles_id=role_id WHERE user_id=:num');
    $req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
    $req->execute();
    $contact = $req->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="txt-center">
        <h1 class="h1">Gestion des utilisateurs</h1>
        <!--Début du formulaire------>
        <form class="form form--m center" method="post">
            <h2><strong>Modification de l'utilisateur</h2>
            <fieldset>
                <div>
                    <label class="size-s" for="user_nom">Nom :</label>
                    <input id="user_nom" name="user_nom" type="text" value="<?= $contact['user_nom']; ?>" placeholder="Nom de l'utilisateur" required>
                </div>
                <br>
                <div>
                    <label class="size-s" for="user_prenom">Prénom :</label>
                    <input id="user_prenom" name="user_prenom" type="text" placeholder="Prénom de l'utilisateur" value="<?= $contact['user_prenom']; ?>" required>
                </div>
                <br>
                <div>
                    <label class="size-s" for="user_email">Email :</label>
                    <input id="user_email" name="user_email" type="email" placeholder="Email de l'utilisateur" value="<?= $contact['user_email']; ?>" required>
                </div>

                <div>
                    <label class="size-s" for="user_adresse">Adresse:</label>
                    <input id="user_adresse" name="user_adresse" type="text" placeholder="Adresse de l'utilisateur" value="<?= $contact['user_adresse']; ?>" required>
                </div>

                <div>
                    <label class="size-s" for="user_cp">Code Postal:</label>
                    <input id="user_cp" name="user_cp" type="text" placeholder="Code postal de l'utilisateur" value="<?= $contact['user_cp']; ?>" required>
                </div>

                <div>
                    <label class="size-s" for="user_ville">Ville:</label>
                    <input id="user_ville" name="user_ville" type="text" placeholder="Ville de l'utilisateur" value="<?= $contact['user_ville']; ?>" required>
                </div>

                <div>
                    <label class="size-s" for="user_naissance">Date de naissance:</label>
                    <input id="user_naissance" name="user_naissance" type="date" placeholder="Date de naissance de l'utilisateur" value="<?= $contact['user_naissance']; ?>" required>
                </div>

                <div>
                    <label class="size-s" for="user_tel">Téléphone:</label>
                    <input id="user_tel" name="user_tel" type="text" placeholder="Téléphone de l'utilisateur" value="<?= $contact['user_tel']; ?>" required>
                </div>
            </fieldset>

            <fieldset>
                <div class="txt-center">
                    <legend>Privilèges</legend>
                    <br>
                </div>
                <div>
                    <label class="size-s" for="role_id">Rôle :</label>
                    <select name="role_id" id="role_id" required>
                        <OPTION value="<?= $contact['role_id']; ?>" selected><?= $contact['role_nom']; ?></option>
                        <?php if ($contact['role_nom'] == 'Administrateur') : ?>
                            <OPTION value="02">Membre</option>
                            <OPTION value="03">Responsable</option>
                        <?php endif ?>
                        <?php if ($contact['role_nom'] == 'Membre') : ?>
                            <OPTION value="01">Administrateur</option>
                            <OPTION value="03">Responsable</option>
                        <?php endif ?>
                        <?php if ($contact['role_nom'] == 'Responsable') : ?>
                            <OPTION value="01">Administrateur</option>
                            <OPTION value="02">Membre</option>
                        <?php endif ?>

                    </select>
                </div>
            </fieldset>

            <div class="txt-center">
                <a class="btn--cancel" href="membres.php">Annuler</a>
                <input class="btn--custom" type="submit" value="Enregistrer les modifications" id="update_user" name="update_user" />
            </div>
            <?php
            if (isset($_POST['update_user']) && ($_POST['user_nom']) && ($_POST['user_prenom']) && ($_POST['user_naissance']) && ($_POST['user_email']) && ($_POST['user_cp']) && ($_POST['user_tel'])) {
                $req = $pdo->prepare('UPDATE users SET user_nom = :user_nom, user_prenom = :user_prenom, user_email = :user_email, user_naissance= :user_naissance, user_adresse= :user_adresse, user_cp= :user_cp, user_tel= :user_tel, user_ville= :user_ville, role_id= :role_id  WHERE user_id=:num ');
                $req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
                $req->bindValue(':user_nom', $_POST['user_nom'], PDO::PARAM_STR);
                $req->bindValue(':user_prenom', $_POST['user_prenom'], PDO::PARAM_STR);
                $req->bindValue(':user_email', $_POST['user_email'], PDO::PARAM_STR);
                $req->bindValue(':user_naissance', $_POST['user_naissance'], PDO::PARAM_STR);
                $req->bindValue(':user_adresse', $_POST['user_adresse'], PDO::PARAM_STR);
                $req->bindValue(':user_cp', $_POST['user_cp'], PDO::PARAM_STR);
                $req->bindValue(':user_tel', $_POST['user_tel'], PDO::PARAM_STR);
                $req->bindValue(':user_ville', $_POST['user_ville'], PDO::PARAM_STR);
                $req->bindValue(':role_id', $_POST['role_id'], PDO::PARAM_INT);
                $req->execute();
                $executeIsOK = $req->execute();
                if ($executeIsOK) {
                    header("refresh:3;url=membres.php");
                    echo ("<div class='txt-center'><div class='success-msg'><i class='fa fa-check'></i> L'utilisateur a bien été modifié</div></div>");
                    echo 'Les données vont être rafraichies dans 3 secondes. Sinon cliquez <a href="membres.php">ici</a>.';
                } else {
                    echo ("<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> La modification a échouée</div></div>");
                }
            }
            ?>
        </form>
    </div>
    </div>
</body>

</html>