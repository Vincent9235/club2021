<?php
session_start();   //La session démarre
require('db.php'); //Appel de la DB
?>
<?php if ($_SERVER['PHP_SELF'] == "/club2021/connexion.php") : ?>
    <!DOCTYPE html><!-- Doctype HTML 5-->
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Vincent Laurens">
        <meta name="description" content="Club 2021">
        <title>Se connecter</title>
        <link type="text/css" rel="stylesheet" href="css/formulaire.css" media="screen" />
    </head>
<?php endif ?>

<?php if ($_SERVER['PHP_SELF'] == "/club2021/inscription.php" or $_SERVER['PHP_SELF'] == "/club2021/remplir_info.php") : ?>
    <!DOCTYPE html><!-- Doctype HTML 5-->
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Vincent Laurens">
        <meta name="description" content="Club 2021">
        <title>S'inscrire</title>
        <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    </head>

    <body>
    <?php endif ?>
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/index.php") : ?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Accueil</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        </head>
    <?php endif ?>

    <!-------Condition ACTUALITE.PHP && ARTICLE.PHP----->

    <?php if ($_SERVER['PHP_SELF'] == "/club2021/article/actualite.php" or $_SERVER['PHP_SELF'] == "/club2021/article/article.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Actualités</title>
            <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                echo ($message);
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <?php if (isset($_SESSION['auth'])) : ?>
                <a href="actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
            <?php endif ?>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth']->role_role == 'admin') : ?>
                <a href="admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
            <?php endif ?>
        </header>
    <?php endif ?>

    <!-------Condition REDACTION.PHP----->

    <?php if ($_SERVER['PHP_SELF'] == "/club2021/article/redaction.php") : ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Rédaction / Edition</title>
            <link rel="stylesheet" href="../css/formulaire.css">
            <link rel="stylesheet" href="../css/wbbtheme.css">
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script src="../js/jquery.wysibb.min.js"></script>
            <script src="../js/fr.js"></script>
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                echo ($message);
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <?php if (isset($_SESSION['auth'])) : ?>
                <a href="actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
            <?php endif ?>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth']->role_role == 'admin') : ?>
                <a href="admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
            <?php endif ?>
        </header>
    <?php endif ?>



    <!-------Condition PROFIL.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/profil.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Mon profil</title>
            <link type="text/css" rel="stylesheet" href="css/formulaire.css" media="screen" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                echo ($message);
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <?php if (isset($_SESSION['auth'])) : ?>
                <a href="article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                <a href="profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
            <?php endif ?>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth']->role_role == 'admin') : ?>
                <a href="admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
            <?php endif ?>
        </header>
    <?php endif ?>



    <!-------Condition modif_profil.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/modif_profil.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Modification du profil</title>
            <link type="text/css" rel="stylesheet" href="css/formulaire.css" media="screen" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                echo ($message);
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <?php if (isset($_SESSION['auth'])) : ?>
                <a href="article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                <a href="profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
            <?php endif ?>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth']->role_role == 'admin') : ?>
                <a href="admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
            <?php endif ?>
        </header>
    <?php endif ?>