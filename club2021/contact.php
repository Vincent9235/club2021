	<?php
	require('inc/header.php');
	if (isset($_POST['mailform'])) {
		if (!empty($_POST['nom']) and !empty($_POST['mail']) and !empty($_POST['message'])) {
			$header = "MIME-Version: 1.0\r\n";
			$header .= 'From:"Maison des ligues"<vincentf.laurens@gmail.com>' . "\n";
			$header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
			$header .= 'Content-Transfer-Encoding: 8bit';
			$message = '
	      <html>
	         <body>
	            <div align="center">
	               <br />
	               <u>Nom de l\'expéditeur :</u>' . $_POST['nom'] . '<br />
	               <u>Mail de l\'expéditeur :</u>' . $_POST['mail'] . '<br />
	               <br />
	               ' . nl2br($_POST['message']) . '
	               <br />
                   <img src="https://image.freepik.com/vecteurs-libre/contactez-nous-concept-illustration_114360-2299.jpg"/>
	            </div>
	         </body>
	      </html>
	      ';
			mail("vincentf.laurens@gmail.com", "Contact M2L", $message, $header);
			$msg = '<div class="success-msg">Votre message a bien été envoyé </div>';
		} else {
			$msg = '<div class="error-msg">Tous les champs doivent être complétés </div>';
		}
	}
	?>
	<body>
		<div class="content1col">
		<h2 class="h1"><i class="fa fa-envelope"></i> Contacter la maison des ligues</h2>
		</div>
		<form class="form--m center" method="POST" action="">
			<input type="text" name="nom" placeholder="Votre nom" value="<?php if (isset($_POST['nom'])) {
																				echo $_POST['nom'];
																			} ?>" /><br /><br />
			<input type="email" name="mail" placeholder="Votre email" value="<?php if (isset($_POST['mail'])) {
																					echo $_POST['mail'];
																				} ?>" /><br /><br />
			<textarea name="message" placeholder="Votre message, cela peut être une demande ou même une remarque"><?php if (isset($_POST['message'])) {
																		echo $_POST['message'];
																	} ?></textarea><br /><br />
			<input type="submit" value="Envoyer le message" name="mailform" />
		</form>
		<?php if (isset($msg)) {
			echo $msg;
		}
		?>
	</body>

	</html>