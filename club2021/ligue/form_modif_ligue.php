<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])){
    header('Location:../connexion.php');exit;
 }
 //Si l'utilisateur est un membre, redirection à la page actualite.php
 if ($_SESSION['auth']->role_role == 'member') {
    header('Location:../article/actualite.php');exit;
 }
$req = $pdo->prepare('SELECT  * FROM ligues WHERE ligue_id=:num');
$req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
$req->execute();
$contact = $req->fetch(PDO::FETCH_ASSOC);
?>
<body>
    <div class="txt-center">
        <h1 class="h1">Modifier la ligue</h1>
        <!--Début du formulaire------>
        <form class="form form--m center" method="post" action="">
            <h2><strong>Modification de la ligue</h2>
            <fieldset>
                <div>
                    <label class="size-s" for="ligue_nom">Nom du ligue:</label>
                    <input id="ligue_nom" name="ligue_nom" type="text" value="<?= $contact['ligue_nom']; ?>" placeholder="Nom du ligue" required>
                </div>
                <br>
                <div>
                    <label class="size-s" for="ligue_adresse">Adresse du ligue :</label>
                    <input id="ligue_adresse" name="ligue_adresse" type="text" placeholder="Adresse du ligue" value="<?= $contact['ligue_adresse']; ?>" required>
                </div>
                <br>
                <div>
                    <label class="size-s" for="ligue_cp">Code postal du ligue</label>
                    <input id="ligue_cp" name="ligue_cp" type="text" placeholder="Code postal du ligue" value="<?= $contact['ligue_cp']; ?>" required>
                </div>
                <div>
                    <label class="size-s" for="ligue_ville">Ville du ligue</label>
                    <input id="ligue_ville" name="ligue_ville" type="text" placeholder="Ville du ligue" value="<?= $contact['ligue_ville']; ?>" required>
                </div>
                <div>
                    <label class="size-s" for="ligue_tel">Téléphone du ligue</label>
                    <input id="ligue_tel" name="ligue_tel" type="text" placeholder="Téléphone du ligue" value="<?= $contact['ligue_tel']; ?>" required>
                </div>
                <div>
                    <label class="size-s" for="ligue_email">Email du ligue</label>
                    <input id="ligue_email" name="ligue_email" type="text" placeholder="Email du ligue" value="<?= $contact['ligue_email']; ?>" required>
                </div>
            </fieldset>

            <div class="txt-center">
                <a class="btn--cancel" href="ligue.php">Annuler</a>
                <input class="btn--default" type="submit" value="Enregistrer les modifications" id="update_ligue" name="update_ligue" />
            </div>

            <?php
            if (isset($_POST['ligue_nom']) && ($_POST['ligue_adresse']) && ($_POST['ligue_cp']) && ($_POST['ligue_ville']) && ($_POST['ligue_email'])) {
                $req = $pdo->prepare('UPDATE ligues SET ligue_nom = :ligue_nom, ligue_adresse = :ligue_adresse, ligue_cp = :ligue_cp, ligue_ville= :ligue_ville, ligue_email= :ligue_email, ligue_tel= :ligue_tel WHERE ligue_id=:num ');
                $req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
                $req->bindValue(':ligue_nom', $_POST['ligue_nom'], PDO::PARAM_STR);
                $req->bindValue(':ligue_adresse', $_POST['ligue_adresse'], PDO::PARAM_STR);
                $req->bindValue(':ligue_cp', $_POST['ligue_cp'], PDO::PARAM_STR);
                $req->bindValue(':ligue_ville', $_POST['ligue_ville'], PDO::PARAM_STR);
                $req->bindValue(':ligue_email', $_POST['ligue_email'], PDO::PARAM_STR);
                $req->bindValue(':ligue_tel', $_POST['ligue_tel'], PDO::PARAM_STR);
                $req->execute();
                $executeIsOK = $req->execute();
                if ($executeIsOK) {
                    echo ("<div class='txt-center'><div class='success-msg'><i class='fa fa-check'></i> Le ligue a bien été modifié</div></div>");
                    echo 'Les données vont être rafraichies dans 3 secondes. Sinon cliquez <a href="ligue.php">ici</a>.';
                } else {
                    echo ("<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> La modification a échouée</div></div>");
                }
            }
            ?>

        </form>
    </div>
</body>

</html>