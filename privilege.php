<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("auth.php");

if (file_exists("private/passwd"))
{
//Modifier le titre de la page
shop_header("Modification des utilisateurs");
echo "<body>";
if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "")
	$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
if ($_SESSION["loggued_on_user"])
{
$tab = unserialize(file_get_contents("private/passwd"));
if (is_array($tab))
{
	print_r($_POST);
	echo "<form action='". $_SERVER['REQUEST_URI'] . "' method='post'>";
	echo "<table>";

foreach ($tab as $user)
{
	echo "<tr>
		<td>". $user["login"] . "</td>
		<td>
		<input type='checkbox' name='is_admin[]' value='". $user['login']. "'";
	if ($user["is_admin"])
		echo " checked='checked'";
	if ($user["login"] == $_SESSION["loggued_on_user"])
		echo " disabled";
		echo "></td>";
	echo "</tr>";
}
	echo "</table>";
echo "<input type='submit' value='valider' /></form>";
}
else
echo "Probleme à la lecture de la base utilisateur";
}
else
{

login_form($_SERVER['PHP_SELF']);
}
}
else
	header("Location: install.php");
?>
</body>
</html>
