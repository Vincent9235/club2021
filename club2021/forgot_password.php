<?php
require('inc/header.php');
?>
<body>
    <h2 class="h1">Mot de passe oublié</h2>
    <form class="form form--m center" method="post">
        <input type="email" name="email" value="" placeholder="Entrer votre email" />
        <input type="submit" name="submit_email" value="Envoyer un nouveau mot de passe" />
<?php
if (isset($_POST['email']) and isset($_POST['submit_email'])) {
    //On vérifie que l'email saisi existe bien. 
    $req = $pdo->prepare('SELECT user_id,user_email from Users WHERE user_email= ?');
    $req->execute([$_POST['email']]);
    $verif_email = $req->fetch();
    if (@$verif_email->user_email) {
        $password = uniqid();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $message = "Bonjour, voici votre nouveau mot de passe: $password";
        $headers = 'Content-Type: text/plain; charset="utf-8"' . "";
        if (mail($_POST['email'], 'Votre nouveau mot de passe', $message, $headers)) {
            $sql = "UPDATE Users SET user_mdp = ? WHERE user_email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$hashedPassword, $_POST['email']]);
            echo "<div class='success-msg'><i class='fa fa-check'></i> Mail envoyé</div>";
        }
    } else {
        echo "<div class='error-msg'><i class='fa fa-times-circle'></i> Cet email n'est associé à aucun compte</div>";
        die();
    }
}
?>
</form>
</body>
</html>