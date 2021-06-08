<?php
require('inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page index.php
if (!isset($_SESSION['auth'])) {
	header('Location:index.php');
	exit();
}
?>
<html>
<?php
$req = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
$req->execute(array($_SESSION['auth']->user_id));
$user = $req->fetch(PDO::FETCH_ASSOC);
?>

<body>
	<div class="txt-center">
		<h2 class="h1">Edition du profil</h2>
		
			<form class="form form--m center" method="POST" action="" enctype="multipart/form-data">
				<label>Adresse: </label>
				<input type="text" name="newadresse" placeholder="Nouvelle adresse" value="<?= $user['user_adresse']; ?>" /><br /><br />
				<label>Ville: </label>
				<input type="text" name="newville" placeholder="Nouvelle ville" value="<?= $user['user_ville']; ?>" /><br /><br />
				<label>Code postal: </label>
				<input type="text" name="newcp" placeholder="Nouveau code postal" value="<?= $user['user_cp']; ?>" /><br /><br />
				<label>Mail:</label>
				<input type="text" name="newmail" placeholder="Mail" value="<?= $user['user_email']; ?>" /><br /><br />
				<label>Téléphone: </label>
				<input type="text" name="newtel" placeholder="Nouveau téléphone" value="<?= $user['user_tel']; ?>" /><br /><br />
				<label>Mot de passe:</label>
				<input type="password" name="newmdp1" placeholder="Mot de passe" /><br /><br />
				<label>Confirmation du mot de passe:</label>
				<input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
				<a class="btn--cancel" href="profil.php">Annuler</a>
				<input class="btn--default" type="submit" name="maj_profil" value="Mettre à jour le profil " />

				<?php
				if (isset($user['user_id']) && isset($_POST['maj_profil'])) {
					//Modif Adresse
					if (isset($_POST['newadresse']) and !empty($_POST['newadresse']) and $_POST['newadresse'] != $user['user_adresse']) {
						$newadresse = htmlspecialchars($_POST['newadresse']);
						$insertadresse = $pdo->prepare("UPDATE Users SET user_adresse = ? WHERE user_id = ?");
						$insertadresse->execute(array($newadresse, $user['user_id']));
						header('Location: profil.php?id=' . $user['user_id']);
					}
					//Modif Ville
					if (isset($_POST['newville']) and !empty($_POST['newville']) and $_POST['newville'] != $user['user_ville']) {
						$newville = htmlspecialchars($_POST['newville']);
						$insertville = $pdo->prepare("UPDATE Users SET user_ville = ? WHERE user_id = ?");
						$insertville->execute(array($newville, $user['user_id']));
						header('Location: profil.php?id=' . $user['user_id']);
					}
					//Modif CodePostal
					if (isset($_POST['newcp']) and !empty($_POST['newcp']) and $_POST['newcp'] != $user['user_cp']) {
						$newcp = htmlspecialchars($_POST['newcp']);
						$insercp = $pdo->prepare("UPDATE Users SET user_cp = ? WHERE user_id = ?");
						$insercp->execute(array($newcp, $user['user_id']));
						header('Location: profil.php?id=' . $user['user_id']);
					}
					//Modif Mail
					if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['user_email']) {
						$newmail = htmlspecialchars($_POST['newmail']);
						if (filter_var($newmail, FILTER_VALIDATE_EMAIL)) {
							//Le script est exécuté
							$insertmail = $pdo->prepare("UPDATE Users SET user_email = ? WHERE user_id = ?");
							$insertmail->execute(array($newmail, $user['user_id']));
							header('Location: profil.php?id=' . $user['user_id']);
						} else {
							//Erreur dans la saisie de l'email fin du script
							echo ("<div class='error-msg'><i class='fa fa-times-circle'></i><strong> Le format de l'adresse mail saisi est invalide</strong></div>");
						}
					}
					//Modif Téléphone
					if (isset($_POST['newtel']) and !empty($_POST['newtel']) and $_POST['newtel'] != $user['user_tel']) {
						$newtel = htmlspecialchars($_POST['newtel']);
						$insertel = $pdo->prepare("UPDATE Users SET user_tel = ? WHERE user_id = ?");
						$insertel->execute(array($newtel, $user['user_id']));
						header('Location: profil.php?id=' . $user['user_id']);
					}
					//Modif mot de passe
					if (isset($_POST['newmdp1']) and !empty($_POST['newmdp1'] and $_POST['newmdp1'] == $_POST['newmdp2'])) {
						$newmdp = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
						$insertpassword = $pdo->prepare("UPDATE Users SET user_mdp =? WHERE user_id = ?");
						$insertpassword->execute(array($newmdp, $user['user_id']));
						header('Location: profil.php?id=' . $user['user_id']);
					} else {
						echo ("<div class='error-msg'><i class='fa fa-times-circle'></i> Vos deux mot de passe ne correspondent pas</div>");
					}
				}
				?>
			</form>
	</div>
</body>
</html>