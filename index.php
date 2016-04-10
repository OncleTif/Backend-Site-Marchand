<?php
session_start();
include "shop_header.php";
include "login_form.php";
include "get_items.php";
include "modif_cart.php";
include "add_to_cart.php";
include "archive_cart.php";
include "archive_form.php";
include "auth.php";

if (!$_SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
  $_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	}

shop_header("Shop Accueil");
if ($_POST["form"] === "modif_cart")
modif_cart($_POST);
else if ($_POST["form"] === "add_to_cart")
	add_to_cart($_POST);
else if ($_POST["form"] === "archive_cart")
	archive_cart($_POST);





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
				?>
			</div>
			<div class="login">
				<a href="create.html">Cr&eacute;er un compte</a>
				<br /><br />
				<?php
if ($_SESSION["loggued_on_user"] != "")
	echo "<p>Bonjour ". $_SESSION["loggued_on_user"]. "!</p>";
	else
				login_form($_SERVER["PHP_SELF"]); ?>
			<div class="cart">
				<p>Panier</p>
<?php
				if ($_SESSION["loggued_on_user"] != "")
{
archive_form($_SERVER['PHP_SELF']);

}
				 include("print_cart.php");
				?>
			</div>
			</div>
		</div>
	</body>
</html>
