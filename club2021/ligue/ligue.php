<?php
require('../inc/header.php');
if (!isset($_SESSION['auth'])) {
    header('Location:../connexion.php');
    exit;
}
?>

<body>
    <div class="txt-center">
        <br>
        <?php if ($_SESSION['auth']->role_role == 'admin' or $_SESSION['auth']->role_role == 'responsable') : ?>
            <a class="btn--default" href="form_add_ligue.php">
                <span class="icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                Ajouter une ligue</a>
        <?php endif ?>
    </div>
    <!--Formulaire de recherche--->
    <form class="form form--m center" method="GET">
        <input type="search" name="q" placeholder="Recherche par nom" value="<?= isset($_GET['q']) ? $_GET['q'] : null ?>" />
        <input type="submit" value="Valider" />
    </form>
    <div class="content1col"></div>
    <?php
    /*******************REQUETE SQL  *******************/
    //$products = $pdo->query( "SELECT  * FROM users LEFT JOIN roles ON roles_id=role_id ORDER BY user_id desc LIMIT 10 ")->fetchAll(PDO::FETCH_ASSOC);
    $query = "SELECT * FROM ligues ";
    $queryCount = "SELECT count(ligue_id) as count FROM ligues";
    $params = [];

    //Recherche par nom
    if (!empty($_GET['q'])) {
        $query .= " WHERE ligue_nom LIKE :ligue_nom";
        $queryCount .= " WHERE ligue_nom LIKE :ligue_nom";
        $params['ligue_nom'] = '%' . $_GET['q'] . '%';
    }

    //Pagination
    define('PER_PAGE', 20);
    $page = (int)(isset($_GET['p']) ? $_GET['p'] : 1);
    $offset = ($page - 1) * PER_PAGE;
    $query .= " LIMIT " . PER_PAGE . " OFFSET $offset";
    $statement = $pdo->prepare($query);
    $statement->execute($params);
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement = $pdo->prepare($queryCount);
    $statement->execute($params);
    $count = (int)$statement->fetch(PDO::FETCH_ASSOC)['count'];
    $pages = ceil($count / PER_PAGE);
    function withParam($param, $value)
    {
        return http_build_query(array_merge($_GET, [$param => $value]));
    }
    ?>
    <!------Tableau clubs---->
    <table class="table">
        <thead>
            <tr>
                <?php if ($_SESSION['auth']->role_role == 'admin' or $_SESSION['auth']->role_role == 'responsable') : ?>
                    <th>ID</th>
                <?php endif ?>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Email</th>
                <?php if ($_SESSION['auth']->role_role == 'admin' or $_SESSION['auth']->role_role == 'responsable') : ?>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                <?php endif ?>
            </tr>

            <?php foreach ($products as $product) : ?>
                <tr>
                    <?php if ($_SESSION['auth']->role_role == 'admin' or $_SESSION['auth']->role_role == 'responsable') : ?>
                        <td><?= $product['ligue_id'] ?></td>
                    <?php endif ?>
                    <td><?= $product['ligue_nom'] ?></td>
                    <td><?= $product['ligue_adresse'] ?></td>
                    <td><?= $product['ligue_cp'] ?></td>
                    <td><?= $product['ligue_ville'] ?></td>
                    <td><?= $tel = implode(' ', str_split($product['ligue_tel'], 2)); ?></td>
                    <td><?= $product['ligue_email'] ?></td>
                    <?php if ($_SESSION['auth']->role_role == 'admin' or $_SESSION['auth']->role_role == 'responsable') : ?>
                        <td><a class="btn--default btn-mini" href="form_modif_ligue.php?numID=<?= $product['ligue_id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true" name="update"></i></a></td>
                        <!--<td><form method="post" action=""><input class="btn--custom" type="submit" value="Supprimer" id="delete_user" name="delete_user"/></form></td>-->
                        <td><a class="btn--delete btn-mini delete-confirm" href="form_suppr_ligue.php?numID=<?= $product['ligue_id'] ?>" onclick="return confirm('Souhaitez vous supprimer cette ligue ?')"><i class="fa fa-trash-o" aria-hidden="true" name="suppr"></i></a></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
    </table>
    <?php if ($pages > 1 && $page > 1) : ?>
        <a href="?<?= withParam("p", $page - 1) ?>" class="btn btn--custom">Page précédente</a>
    <?php endif ?>
    <?php if ($pages > 1 && $page < $pages) : ?>
        <a href="?<?= withParam("p", $page + 1) ?>" class="btn btn--custom">Page suivante</a>
    <?php endif ?>
</body>

</html>