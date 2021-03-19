<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])){
    header('Location:../connexion.php');exit;
}
//Si l'utilisateur est un membre, redirection à la page actualite.php
if ($_SESSION['auth']->role_role == 'member') {
    header('Location:article/actualite.php');
}
$mode_edition = 0;
if (isset($_GET['edit']) and !empty($_GET['edit'])) {
	$mode_edition = 1;
	$edit_id = htmlspecialchars($_GET['edit']);
	$edit_article = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
	$edit_article->execute(array($edit_id));
	if ($edit_article->rowCount() == 1) {
		$edit_article = $edit_article->fetch();
	} else {
		die('Erreur : l\'article n\'existe pas...');
	}
}
if (isset($_POST['article_titre'], $_POST['article_contenu'])) {
	if (!empty($_POST['article_titre']) and !empty($_POST['article_contenu'])) {

		$article_titre = htmlspecialchars($_POST['article_titre']);
		$article_contenu = htmlspecialchars($_POST['article_contenu']);
		if ($mode_edition == 0) {
			$ins = $pdo->prepare('INSERT INTO articles (titre, contenu, date_time_publication) VALUES (?, ?, NOW())');
			$ins->execute(array($article_titre, $article_contenu));
			$message = 'Votre article a bien été posté';
		} else {
			$update = $pdo->prepare('UPDATE articles SET titre = ?, contenu = ?, date_time_edition = NOW() WHERE id = ?');
			$update->execute(array($article_titre, $article_contenu, $edit_id));
			header('Location: article.php?id=' . $edit_id);
			$message = 'Votre article a bien été mis à jour !';
		}
	} else {
		$message = 'Veuillez remplir tous les champs';
	}
}
?>
<body>
	<form method="POST">
		<input type="text" name="article_titre" placeholder="Titre" <?php if ($mode_edition == 1) { ?> value="<?=
																												$edit_article->titre ?>" <?php } ?> /><br />
		<textarea id="wysibb" name="article_contenu" placeholder="Contenu de l'article"><?php if ($mode_edition == 1) { ?><?=
																															$edit_article->contenu?><?php } ?></textarea><br />
		<input type="submit" value="Envoyer l'article" />
	</form>
	<br />
	<?php if (isset($message)) {
		echo $message;
	} ?>


	<script>
		$(function() {
			var optionsWbb = {
				buttons: "bold,italic,underline,|,justifycenter,|,img,link,|,code,monbouton",
				lang: "fr",
				allButtons: {
					monbouton: {
						title: 'Bouton Custom',
						buttonText: 'MON BOUTON',
						transform: {
							'<div class="maclasscustom">{SELTEXT}</div>': '[monbouton]{SELTEXT}[/monbouton]'
						}
					}
				}
			}
			$("#wysibb").wysibb(optionsWbb);
		})
	</script>
</body>

</html>