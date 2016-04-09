<?php

include "shop_header.php";

shop_header("Shop Acceuil");

?>

<!-- <!doctype html>
<html lang="fr">
	<head>
		<title>Shop Acceuil</title>
		<meta charset="utf-8" />
	</head>
	<body> -->
		<div class="category">
		</div>
		<div class="window">
		</div>
		<div class="login">
			<form action="login.php" method="POST">
				Identifiant: <input type="text" name="login" value="" />
				<br />
				Mot de passe: <input type="password" name="passwd" value="" />
				<br />
				<input type="submit" name="submit" value="OK" />
			</form>
			<br />
			<a href="create.html">Cr&eacute;er un compte</a>
			<br />
			<a href="modif.html">Modifier le mot de passe</a>
		</div>
	</body>
</html>
