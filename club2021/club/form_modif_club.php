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
$req = $pdo->prepare('SELECT  * FROM clubs WHERE club_id=:num');
$req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
$req->execute();
$contact = $req->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <div class="txt-center">
        <h1 class="h1">Modifier un club</h1>
        <!--Début du formulaire------>
        <form class="form form--m center" method="post" action="">
            <h2><strong>Modification du club</h2>
            <fieldset>
                <div>
                    <label class="size-s" for="club_nom">Nom du club:</label>
                    <input id="club_nom" name="club_nom" type="text" value="<?= $contact['club_nom']; ?>" placeholder="Nom du club" required>
                </div>
                <br>
                <div>
                    <label class="size-s" for="club_adresse">Adresse du club :</label>
                    <input id="club_adresse" name="club_adresse" type="text" placeholder="Adresse du club" value="<?= $contact['club_adresse']; ?>" required>
                </div>
                <br>
                <div>
                    <label class="size-s" for="club_cp">Code postal du club</label>
                    <input id="club_cp" name="club_cp" type="text" placeholder="Code postal du club" value="<?= $contact['club_cp']; ?>" required>
                </div>
                <div>
                    <label class="size-s" for="club_ville">Ville du club</label>
                    <input id="club_ville" name="club_ville" type="text" placeholder="Ville du club" value="<?= $contact['club_ville']; ?>" required>
                </div>
                <div>
                    <label class="size-s" for="club_tel">Téléphone du club</label>
                    <input id="club_tel" name="club_tel" type="text" placeholder="Téléphone du club" value="<?= $contact['club_tel']; ?>" required>
                </div>
                <div>
                    <label class="size-s" for="club_email">Email du club</label>
                    <input id="club_email" name="club_email" type="text" placeholder="Email du club" value="<?= $contact['club_email']; ?>" required>
                </div>
            </fieldset>

            <div class="txt-center">
                <a class="btn--cancel" href="club.php">Annuler</a>
                <input class="btn--default" type="submit" value="Enregistrer les modifications" id="update_club" name="update_club" />
            </div>

            <?php
            if (isset($_POST['club_nom']) && ($_POST['club_adresse']) && ($_POST['club_cp']) && ($_POST['club_ville']) && ($_POST['club_email'])) {
                $req = $pdo->prepare('UPDATE clubs SET club_nom = :club_nom, club_adresse = :club_adresse, club_cp = :club_cp, club_ville= :club_ville, club_email= :club_email, club_tel= :club_tel WHERE club_id=:num ');
                $req->bindValue(':num', $_GET['numID'], PDO::PARAM_INT);
                $req->bindValue(':club_nom', $_POST['club_nom'], PDO::PARAM_STR);
                $req->bindValue(':club_adresse', $_POST['club_adresse'], PDO::PARAM_STR);
                $req->bindValue(':club_cp', $_POST['club_cp'], PDO::PARAM_STR);
                $req->bindValue(':club_ville', $_POST['club_ville'], PDO::PARAM_STR);
                $req->bindValue(':club_email', $_POST['club_email'], PDO::PARAM_STR);
                $req->bindValue(':club_tel', $_POST['club_tel'], PDO::PARAM_STR);
                $req->execute();
                $executeIsOK = $req->execute();
                if ($executeIsOK) {
                    echo ("<div class='txt-center'><div class='success-msg'><i class='fa fa-check'></i> Le club a bien été modifié</div></div>");
                    echo 'Les données vont être rafraichies dans 3 secondes. Sinon cliquez <a href="club.php">ici</a>.';
                } else {
                    echo ("<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> La modification a échouée</div></div>");
                }
            }
            ?>

        </form>
    </div>
</body>

</html>