<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])){
    header('Location:../connexion.php');exit;
}
//Selection de l'article demandé
if (isset($_GET['id']) and !empty($_GET['id'])) {
	$get_id = htmlspecialchars($_GET['id']);
	$article = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
	$article->execute(array($get_id));
	if ($article->rowCount() == 1) {
		$article = $article->fetch();
		$titre = $article->titre;
		$contenu = $article->contenu;
	} else {
		die("<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> Cet article n'existe pas</div></div>");
	}
} else {
	die("<div class='txt-center'><div class='error-msg'><i class='fa fa-times-circle'></i> Erreur");
}
?>
<body>

	<div class="content1col"></div>
	<div class="txt-center">
	<p><i class="fa fa-user" aria-hidden="true" style="color: #004279;"></i> Publié par: <?= $article->auteur; ?>
	<br><i class="fa fa-calendar"></i> Publié le: <?= $date_publication = strftime('%d/%m/%Y', strtotime($article->date_time_publication)) ?>
	</p>
	<h1><?= $titre ?></h1>
	<p>
		<?php
		require_once('../JBBCode/Parser.php'); //Appel du Parser JBBCode
		$parser = new JBBCode\Parser();
		$parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
		$parser->addBBCode("center", '<div align="center">{param}</div>'); //Appliquer une classe center
		$parser->parse(nl2br($contenu)); //On conserve le retour à la ligne grâce à nl2br()
		echo $parser->getAsHtml(); //On affiche ensuite le BBCode au format HTML
		?></p>
		</div>

</body>

</html>