<?php

include "shop_header.php";

shop_header("Shop Acceuil");

?>

		<div>
			<div class="category">
				<?php
					if (file_exists("private/category") === TRUE) {
						$content = file_get_contents("private/category");
						$tab = unserialize($content);
						$i = 0;
						echo "<form action='shop.php method='POST>";
						while (isset($tab[$i])) {
							echo "<input type='submit' name=".$tab[$i]['category']." value=".$tab[$i]['category']." /></ br>";
							$i++;
						}
						echo "</form>";
					}
				?>
			</div>
			<div class="window">
				<?php
				?>
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
		</div>
	</body>
</html>
