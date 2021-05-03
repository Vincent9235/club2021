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
?>
<body>
<div class="txt-center">
   <br>
<a class="btn--default" href="form_add_user.php">
<span class="icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
Ajouter un membre</a>
</div>
<!--Formulaire de recherche--->
<form class="form form--m center" method="GET">
   <input type="search" name="q" placeholder="Recherche par nom" value="<?= isset($_GET['q'])?$_GET['q']:null ?>"/>
   <input type="submit" value="Valider" />
</form>
<div class="content1col"></div>

<?php
/*******************REQUETE SQL  *******************/
//$products = $pdo->query( "SELECT  * FROM users LEFT JOIN roles ON roles_id=role_id ORDER BY user_id desc LIMIT 10 ")->fetchAll(PDO::FETCH_ASSOC);
$query = "SELECT * FROM users LEFT JOIN roles on roles_id=role_id";
$queryCount = "SELECT count(user_id) as count FROM users";
$params = [];
//Recherche par nom
if(!empty($_GET['q'])){
   $query .= " WHERE user_nom LIKE :user_nom";
   $queryCount .= " WHERE user_nom LIKE :user_nom";
   $params['user_nom'] = '%' . $_GET['q'] . '%';
}
   
   //Pagination
   define('PER_PAGE', 20);
   $page = (int)(isset($_GET['p'])?$_GET['p']:1);
   $offset = ($page-1)*PER_PAGE; 
   $query .= " ORDER BY user_id DESC "; //Affiche les utilisateurs les plus récents en premier
   $query .= " LIMIT " . PER_PAGE . " OFFSET $offset";
   $statement = $pdo->prepare($query);
   $statement->execute($params);
   $products = $statement->fetchAll(PDO::FETCH_ASSOC);
   $statement = $pdo->prepare($queryCount);
   $statement->execute($params);
   $count = (int)$statement->fetch(PDO::FETCH_ASSOC)['count'];
   $pages = ceil($count / PER_PAGE);
   function withParam($param, $value){
      return http_build_query(array_merge($_GET,[$param => $value] ));
   }
   ?>
<!------Tableau membres---->
<table class="table">
<thead>
   <tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Adresse</th>
    <th>Ville</th>
    <th>Code Postal</th>
    <th>Téléphone</th>
    <th>Email</th>
    <th>Date de naissance</th>
    <th>Rôle</th>
    <th>Modifier</th>
    <th>Supprimer</th>
   </tr>

<?php foreach($products as $product):?>
<tr>
<td><?= $product['user_id'] ?></td>
<td><?= $product['user_nom'] ?></td>
<td><?= $product['user_prenom'] ?></td>
<td><?= $product['user_adresse'] ?></td>
<td><?= $product['user_ville'] ?></td>
<td><?= $product['user_cp'] ?></td>
<td><?= $out = implode(' ', str_split($product['user_tel'], 2)); ?></td>
<td><?= $product['user_email'] ?></td>
<td><?=$date_naissance = strftime('%d/%m/%Y', strtotime($product['user_naissance'])) ?></td>
<td><?= $product['role_nom'] ?></td>
<td><a class="btn--default btn-mini" href="form_modif_user.php?numID=<?= $product['user_id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true" name="update"></i></a></td>
<td><a class="btn--delete btn-mini delete-confirm" href="form_suppr_user.php?numID=<?= $product['user_id'] ?>" onclick="return confirm('Souhaitez vous supprimer ce membre?')"><i class="fa fa-trash-o" aria-hidden="true" name="suppr"></i></a></td>
</tr>
<?php endforeach ?>

</table>
<?php if($pages>1 && $page>1):?>
      <a  href="?<?= withParam("p", $page - 1) ?>" class="btn btn--custom">Page précédente</a>
      <?php endif ?>
   <?php if($pages>1 && $page < $pages): ?>
      <a  href="?<?= withParam("p",$page + 1) ?>" class="btn btn--custom">Page suivante</a>
      <?php endif ?>
</body>
</html>