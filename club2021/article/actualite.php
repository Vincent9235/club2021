<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])) {
    header('Location:../connexion.php');
    exit('Vous n\'êtes pas autorisé à accéder à cette page');
}
?>
<body>
    <div class="container">
        <div class="txt-center">
            <h1 class="h1-actu">Les dernières actualités</h1>
            <!--Recherche d'articles--->
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth']->role_role == 'admin' or $_SESSION['auth']->role_role == 'responsable') : ?>
                <a class="btn--default" href="redaction.php">
                    <span class="icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                    Ecrire un nouvel article</a>
            <?php endif ?>
            <form class="form form--m center" method="GET">
                <input type="search" name="q" placeholder="Rechercher un article" value="<?= isset($_GET['q'])?$_GET['q']:null ?>" />
                <input type="submit" value="Valider" />
            </form>
        
        <div class="content3col"></div>
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
            <div class="card-content">
            
                <?php while ($a = $articles->fetch()) { ?>
                    <h1 class="card-header"><a class="a-article" href="article.php?id=<?= $a->id ?>"><?= $a->titre ?></a></h1>
                        <?php if ($_SESSION['auth']->role_role == 'admin') : ?>
                             <a class="btn--default btn-mini" href="redaction.php?edit=<?= $a->id ?>"><i class="fa fa-pencil-square-o" aria-hidden="true" name="update"></i></a>  <a class="btn--delete btn-mini delete-confirm"href="supprimer.php?id=<?= $a->id ?>" onclick="return confirm('Souhaitez vous supprimer cet article ?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                <?php endif ?>
            <?php } ?>

            </div>
        <?php } else { ?>
            <div class="error-msg"><i class='fa fa-times-circle'></i> Aucun résultat pour la recherche: <strong><?= $q ?></strong></div>
        <?php } ?>
        <!--Fin de la recherche---->

        <?php
        $articles = $pdo->query('SELECT * FROM articles ORDER BY date_time_publication DESC'); //Requête pour afficher les articles
        ?>
        <?php
        //Informations de l'utilisateur    
        $req = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
        $req->execute(array($_SESSION['auth']->user_id));
        $user = $req->fetch();
        //var_dump($_SESSION['auth']);
        //Formater date de naissance
        /*$date_naissance = strftime('%d/%m/%Y', strtotime($_SESSION['auth']->user_naissance));
    echo ($date_naissance);*/
        ?>
        </div>
    </div>
</body>
</html>