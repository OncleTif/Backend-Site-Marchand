<?php
session_start();
include "shop_header.php";
include "login_form.php";
include "get_items.php";
include "modif_cart.php";

shop_header("Shop Accueil");
if ($_POST["form"] === "modif_cart")
modif_cart($_POST);





?>
	<body>
		<div class="container">
			<div class="category_list">
				<?php
					if (file_exists("private/item") === TRUE) {
						$content = file_get_contents("private/item");
						$tab = unserialize($content);
						$i = 0;
						echo "<form action='shop.php method='POST>";
						while (isset($tab[$i])) {
							echo "<div class='category'><input type='submit' name=".$tab[$i]['category']." value=".$tab[$i]['category']." /></div>";
							$i++;
						}
						echo "</form>";
					}
				?>
			</div>
			<div class="window">
				<?php
include("shop.php");
var_dump($_SESSION);
include("print_cart.php");
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
