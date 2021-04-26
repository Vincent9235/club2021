<?php
require('inc/header.php');
//Si l'utilisateur n'est pas connecté, redirection à la page index.php
if (!isset($_SESSION['auth'])) {
    header('Location:index.php');
    exit;
}
$req = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
$req->execute(array($_SESSION['auth']->user_id));
$user = $req->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <div class="txt-center">
        <div class="card">
            <div class="card-body">
                <p class="full-name"><?= $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom ?></p>
                <br>
                <p class="city">
                    Mail: <?= $user['user_email']; ?>
                    <br>
                    Adresse: <?= $user['user_adresse'];?>
                    <br>
                    Ville: <?= $user['user_ville']." ".$user['user_cp'];  ?>
                    <br>
                    
                    Teléphone: <?= $out = implode(' ', str_split($user['user_tel'], 2)); ?>
                    <br>
                    Date de naissance: <?= $date_naissance = strftime('%d/%m/%Y', strtotime($user['user_naissance'])); ?>
                </p>
                <?php
                if (isset($user['user_id']) and $user['user_id'] == $user['user_id']) :
                ?>
            </div>
            <div class="card-footer">

                <button class="card-btn"><span></span>
                    <i class="fa fa-pencil-square-o" aria-hidden="true" name="update"></i>
                    <a href="modif_profil.php">Editer mon profil</a>
                </button>
                <button class="card-btn"><span></span>
                    <i class="fa fa-trash-o" aria-hidden="true" name="suppr"></i>
                    <a href="suppr_profil.php" onclick="return confirm('Souhaitez vous vraiment supprimer votre profil ? Cette action est irreversible')">Supprimer mon profil</a>
                </button>
            <?php endif ?>
            </div>
        </div>
    </div>
</body>