<?php
session_start();
include "shop_header.php";
include "login_form.php";
include "modif_cart.php";
include "add_to_cart.php";
include "archive_cart.php";
include "archive_form.php";
include "auth.php";
include "home_form.php";
include "buy_form.php";
include "buy_cart.php";

if (!$_SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
  $_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	}

if (isset($_POST["category"]))
	$_SESSION["category"] = $_POST["category"];

shop_header("Shop Accueil");
if ($_POST["form"] === "modif_cart")
modif_cart($_POST);
else if ($_POST["form"] === "add_to_cart")
	add_to_cart($_POST);
else if ($_POST["form"] === "archive_cart")
	archive_cart();
else if ($_POST["form"] === "buy_cart")
	buy_cart();
else if ($_POST["form"] === "home")
	unset($_SESSION["category"]);




?>
	<body>
		<div class="container">
			<div class="category_list">
				<?php
home_form($_SERVER["PHP_SELF"]);
echo "<div class='category'>";
include "category_form.php";
				?>
			</div>
			</div>
			<div class="window">
				<?php
include("shop.php");
				?>
			</div>
			<div class="login">
				<br /><br />
				<?php
if ($_SESSION["loggued_on_user"] != "")
{
	echo "<p>Bonjour ". $_SESSION["loggued_on_user"]. "!</p>";
	echo "<a href='logout.php' name='deconnecter'>Se déconnecter</a><br />";
	echo "<a href='modif_user.php' name='modifier'>Modifier le mot de passe</a><br />";
	echo "<a href='delete_user.php' name='supprimer'>Supprimer le compte</a><br />";
	echo "<a href='historiq_command.php' name='commandes'>Status des commandes</a>";
	if ($_SESSION["is_admin"])
		echo "<br /><a href='admin.php' name='administrer'>Administrer le site</a>";


	}
else
{
	echo '<a href="create.html">Cr&eacute;er un compte</a>';
	login_form($_SERVER["PHP_SELF"]);
	}
	?>
			<div class="cart">
				<p>Panier</p>
<?php
				if ($_SESSION["loggued_on_user"] != "")
{
archive_form($_SERVER['PHP_SELF']);
}
				 include("print_cart.php");
				if ($_SESSION["loggued_on_user"] != "" && count($_SESSION["cart"]["items"]))
{
buy_form($_SERVER['PHP_SELF']);
}
				?>
			</div>
			</div>
		</div>
	</body>
</html>
