<?php

include "shop_header.php";
include "login_form.php";

shop_header("Shop Acceuil");

?>

		<div class="container">
			<div class="category_list">
				<?php
					if (file_exists("private/item") === TRUE) {
						$content = file_get_contents("private/item");
						$tab = unserialize($content);
						$i = 0;
						echo "<form action='shop.php method='POST>";
						while (isset($tab[$i])) {
							echo "<div class='category'><input size='30' type='submit' name=".$tab[$i]['category']." value=".$tab[$i]['category']." /></div>";
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
				<a href="create.html">Cr&eacute;er un compte</a>
				<br /><br />
				<?php login_form("login.php"); ?>
			</div>
		</div>
	</body>
</html>
