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
        <link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
        <!---CSS Icons--->
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
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
        <link rel="stylesheet" href="css/style.css">
        <!---CSS Icons--->
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

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
            <link rel="stylesheet" href="css/style.css">
            <title>Accueil</title>
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
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
            <link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" />
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
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
            <link rel="stylesheet" href="../css/style.css">
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
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
            </div>
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
            <link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
            
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>

                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="admin/page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
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
            <link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
            
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="admin/page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
        </header>
    <?php endif ?>

    <!-------Condition forgot_password.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/forgot_password.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Mot de passe oublié</title>
            <link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        </head>
    <?php endif ?>

    <!-------Condition CONTACT.PHP----->

    <?php if ($_SERVER['PHP_SELF'] == "/club2021/contact.php") : ?>
        <!DOCTYPE html>
        <html lang="fr">
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Contacter la M2L</title>
            <link rel="stylesheet" href="css/style.css">
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <a href="index.php"><i class="fa fa-home " aria-hidden="true"></i>Accueil</a>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>

            </div>
        </header>
    <?php endif ?>

    <!-------Condition page_admin.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/admin/page_admin.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Administration</title>
            <link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" />

            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
        </header>
    <?php endif ?>

    <!-------Condition CLUB.PHP && Form_modif_club.php && FORM_ADD_CLUB.php----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/club/club.php" or $_SERVER['PHP_SELF'] == "/club2021/club/form_modif_club.php" or $_SERVER['PHP_SELF'] == "/club2021/club/form_add_club.php" or $_SERVER['PHP_SELF'] == "/club2021/club/form_suppr_club.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Administration des clubs</title>
            <link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" />

            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
        </header>
    <?php endif ?>

    <!-------Condition membres.php----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/membres/membres.php" or $_SERVER['PHP_SELF'] == "/club2021/membres/form_modif_user.php" or $_SERVER['PHP_SELF'] == "/club2021/membres/form_suppr_user.php" or $_SERVER['PHP_SELF'] == "/club2021/membres/form_add_user.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Administration des membres</title>
            <link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" />

            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
        </header>
    <?php endif ?>


    <!-------Condition ligues.php----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/ligue/ligue.php" or $_SERVER['PHP_SELF'] == "/club2021/ligue/form_add_ligue.php" or $_SERVER['PHP_SELF'] == "/club2021/ligue/form_modif_ligue.php" or $_SERVER['PHP_SELF'] == "/club2021/ligue/form_suppr_ligue.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Administration des ligues</title>
            <link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" />
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="../article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="../profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="../admin/page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
        </header>
    <?php endif ?>

       <!-------Condition responsable.php----->
       <?php if ($_SERVER['PHP_SELF'] == "/club2021/responsable.php" ) : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="author" content="Vincent Laurens">
            <meta name="description" content="Club 2021">
            <title>Administration des responsables</title>
            <link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
            <!---CSS Icons--->
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        </head>
        <header>
            <div style="text-align:right">
                <i class="fa fa-user" aria-hidden="true" style="color: #ee5f2a;"></i>
                <?php
                if ( !isset($_SESSION['auth'])) {
                    echo ("Vous n'êtes pas connecté(e)");
                } else {
                    $message = $_SESSION['auth']->user_prenom . ' ' . $_SESSION['auth']->user_nom . ' ' . '[' . $_SESSION['auth']->role_nom . ']';
                    echo ($message);
                }
                ?>
                <br>
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Se déconnecter</a>
                <?php endif ?>
                </br>
            </div>
            <div class="nav-top">
                <?php if (isset($_SESSION['auth'])) : ?>
                    <a href="article/actualite.php"><i class="fa fa-home " aria-hidden="true"></i>Actualités</a>
                    <a href="profil.php"><i class="fa fa-user" aria-hidden="true"></i>Mon profil</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'admin' or @$_SESSION['auth']->role_role == 'responsable') : ?>
                    <a href="admin/page_admin.php"><i class="fa fa-cog" aria-hidden="true"></i>Administration</a>
                <?php endif ?>
                <?php if (isset($_SESSION['auth']) && @$_SESSION['auth']->role_role == 'member') : ?>
                    <a href="admin/page_admin.php"><i class="fa fa-info" aria-hidden="true"></i> Informations</a>
                <?php endif ?>
            </div>
        </header>
    <?php endif ?>