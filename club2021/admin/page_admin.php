<?php
require('../inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page connexion.php
if (!isset($_SESSION['auth'])) {
    header('Location:../connexion.php');
    exit;
}
//Si l'utilisateur est un membre, redirection à la page actualite.php
if ($_SESSION['auth']->role_role == 'member') {
    header('Location:../article/actualite.php');
    exit;
}
?>
<body>
    <div class="container">
        <div class="txt-center">
            <div class="container">
                <h2 class="h2">Club</h2>
                <a class="btn btn--custom" href="../club/club.php">Voir les clubs</a>   
                <h2 class="h2">Ligues</h2>
                <a class="btn btn--custom" href="../ligue/ligue.php">Voir les ligues</a>
                <h2 class="h2">Membres de la M2L</h2>
                <a class="btn btn--custom" href="../membres/membres.php">Voir les membres de la M2L</a>               
                <h2 class="h2">Responsables de la M2L</h2>
                <a class="btn btn--custom" href="../responsable.php">Voir les responsables de la M2L</a>
                <div class="content1col"></div>
            </div>
        </div>
    </div>
</body>
</html>