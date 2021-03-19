<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])){
    header('Location:../connexion.php');exit;
}
if (isset($_GET['id']) and !empty($_GET['id'])) {
	$get_id = htmlspecialchars($_GET['id']);
	$article = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
	$article->execute(array($get_id));
	if ($article->rowCount() == 1) {
		$article = $article->fetch();
		$titre = $article->titre;
		$contenu = $article->contenu;
	} else {
		die('Cet article n\'existe pas !');
	}
} else {
	die('Erreur');
}
?>
<body>
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
</body>

</html>