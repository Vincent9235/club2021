<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page index.php
if (!isset($_SESSION['auth'])) {
    header('Location:../connexion.php');
    exit;
}
?>

<body>
    <h1>Les dernières actualités</h1>
    <!--Recherche d'articles--->
    <form method="GET">
        <input type="search" name="q" placeholder="Rechercher un article" />
        <input type="submit" value="Valider" />
    </form>
    <?php
    $articles = $pdo->query('SELECT id,titre FROM articles ORDER BY id DESC');
    if (isset($_GET['q']) and !empty($_GET['q'])) {
        $q = htmlspecialchars($_GET['q']);
        $articles = $pdo->query('SELECT id,titre FROM articles WHERE titre LIKE "%' . $q . '%" ORDER BY id DESC');
        if ($articles->rowCount() == 0) {
            $articles = $pdo->query('SELECT id,titre FROM articles WHERE CONCAT(titre, contenu) LIKE "%' . $q . '%" ORDER BY id DESC');
        }
    }
    ?>
    <?php if ($articles->rowCount() > 0) { ?>
        <ul>
            <?php while ($a = $articles->fetch()) { ?>
                <li><a href="article.php?id=<?= $a->id ?>"><?= $a->titre ?></a></li>

            <?php } ?>
        </ul>
    <?php } else { ?>
        Aucun résultat pour la recherche: <?= $q ?>
    <?php } ?>
    <!--Fin de la recherche---->

    <?php
    $articles = $pdo->query('SELECT * FROM articles ORDER BY date_time_publication DESC'); //Requête pour afficher les articles
    ?>
    <h4>Articles à la une</h4>
    <ul>
        <!--Consultation des articles--->
        <?php while ($a = $articles->fetch()) { ?>
            <li><a href="article.php?id=<?= $a->id ?>"><?= $a->titre ?></a>
                <?php if ($_SESSION['auth']->role_role == 'admin') : ?>
                    | <a href="redaction.php?edit=<?= $a->id ?>">Modifier</a> | <a href="supprimer.php?id=<?= $a->id ?>" onclick="return confirm('Souhaitez vous supprimer cet article?')">Supprimer</a></li>
        <?php endif ?>
    <?php } ?>
    </ul>
    
    <strong><a href="../profil.php">Mon profil </a></strong>
    <?php
    //Informations de l'utilisateur    
    $req = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
    $req->execute(array($_SESSION['auth']->user_id));
    $user = $req->fetch();
    echo ("<br><strong>Bonjour " . $_SESSION['auth']->user_login . " <br>Vous êtes : " . $_SESSION['auth']->user_prenom . " " . $_SESSION['auth']->user_nom."</strong>");
    var_dump($_SESSION['auth']);
    ?>
</body>

</html>