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
        <title>Se connecter</title>
        <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    </head>
<?php endif ?>

<?php if ($_SERVER['PHP_SELF'] == "/club2021/inscription.php" or $_SERVER['PHP_SELF'] == "/club2021/remplir_info.php") : ?>
    <!DOCTYPE html><!-- Doctype HTML 5-->
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <title>Accueil</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        </head>
    <?php endif ?>

    <!-------Condition ACTUALITE.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/article/actualite.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Actualités</title>
            <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        </head>
    <?php endif ?>

    <!-------Condition ARTICLE.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/article/article.php") : ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Accueil</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        </head>
    <?php endif ?>

    <!-------Condition REDACTION.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/article/redaction.php") : ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Rédaction / Edition</title>
            <link rel="stylesheet" href="../css/wbbtheme.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <script src="../js/jquery.wysibb.min.js"></script>
            <script src="../js/fr.js"></script>
        </head>
    <?php endif ?>

    <!-------Condition PROFIL.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/profil.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Mon profil</title>
            <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        </head>
    <?php endif ?>
    <!-------Condition modif_profil.PHP----->
    <?php if ($_SERVER['PHP_SELF'] == "/club2021/modif_profil.php") : ?>
        <!DOCTYPE html><!-- Doctype HTML 5-->
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Modification du profil</title>
            <link type="text/css" rel="stylesheet" href="style01.css" media="screen" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        </head>
    <?php endif ?>