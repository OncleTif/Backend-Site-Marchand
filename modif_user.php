<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("modify_form.php");
include("user_modifier.php");
include("auth.php");

if (file_exists("private/passwd")) {
	//Modifier le titre de la page
	shop_header("Modification des utilisateurs");
	echo "<body>";
	if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
		$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	}
	if ($_SESSION["loggued_on_user"]) {
if ($_POST["form"] === "modif_user" && $_POST["old_pwd"] && $_POST["new_pwd"])
{
if (auth($_SESSION["loggued_on_user"], $_POST["old_pwd"])["loggued_on_user"] != "")
{
user_modifier($_SESSION["new_pwd"]);
}
else
{
	echo "<p class=echec>Mot de passe incorrect</p>";
	     modify_form($_SERVER['PHP_SELF']);
}
}
else
	modify_form($_SERVER['PHP_SELF']);
	} else {
		login_form($_SERVER['PHP_SELF']);
	}
} else {
	header("Location: install.php");
}
?>
</body></html>
