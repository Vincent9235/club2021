<?php 
require('inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])){
   header('Location:connexion.php');exit;
}

?>
<body>
<div class="txt-center">
   <br>
   <?php if($_SESSION['auth']->role_role =='admin' OR $_SESSION['auth']->role_role =='responsable' ): ?>
<a class="btn--default" href="membres/form_add_user.php">
<span class="icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
Ajouter un responsable</a>
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
//$products = $pdo->query( "SELECT  * FROM users LEFT JOIN roles ON roles_id=role_id WHERE role_id=3 ORDER BY user_id desc ")->fetchAll(PDO::FETCH_ASSOC);
$query = "SELECT  * FROM users LEFT JOIN roles ON roles_id=role_id WHERE role_id=3 ";
$params = [];
//Recherche par nom
if (!empty($_GET['q'])) {
    $query .= " AND user_nom LIKE :user_nom";
    $params['user_nom'] = '%' . $_GET['q'] . '%';
}
$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
//var_dump($products);
?>  
<!------Tableau clubs---->
<table class="table">
<thead>
   <tr>
   <?php if($_SESSION['auth']->role_role =='admin' OR $_SESSION['auth']->role_role =='responsable' ): ?>
    <th>ID</th>
    <?php endif ?>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Adresse</th>
    <th>Ville</th>
    <th>Code Postal</th>
    <th>Téléphone</th>
    <th>Email</th>
    <th>Date de naissance</th>
    <th>Rôle</th>
    <?php if($_SESSION['auth']->role_role =='admin' OR $_SESSION['auth']->role_role =='responsable' ): ?>
    <th>Modifier</th>
    <th>Supprimer</th>
    <?php endif ?>
   </tr>
<?php foreach($products as $product):?>
<tr>
<?php if($_SESSION['auth']->role_role =='admin' OR $_SESSION['auth']->role_role =='responsable' ): ?>
<td><?= $product['user_id'] ?></td>
<?php endif ?>
<td><?= $product['user_nom'] ?></td>
<td><?= $product['user_prenom'] ?></td>
<td><?= $product['user_adresse'] ?></td>
<td><?= $product['user_ville'] ?></td>
<td><?= $product['user_cp'] ?></td>
<td><?= $out = implode(' ', str_split($product['user_tel'], 2)); ?></td>
<td><?= $product['user_email'] ?></td>
<td><?=$date_naissance = strftime('%d/%m/%Y', strtotime($product['user_naissance'])) ?></td>
<td><?= $product['role_nom'] ?></td>
<?php if($_SESSION['auth']->role_role == 'admin' OR $_SESSION['auth']->role_role == 'responsable' ): ?>
<td><a class="btn--default btn-mini" href="membres/form_modif_user.php?numID=<?= $product['user_id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true" name="update"></i></a></td>
<td><a class="btn--delete btn-mini delete-confirm" href="membres/form_suppr_user.php?numID=<?= $product['user_id'] ?>" onclick="return confirm('Souhaitez vous supprimer ce membre?')"><i class="fa fa-trash-o" aria-hidden="true" name="suppr"></i></a></td>
<?php endif ?>
</tr>
<?php endforeach ?>

</table>
</body>
</html>