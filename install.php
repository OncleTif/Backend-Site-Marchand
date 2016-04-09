<?php
session_start();
include("shop_header.php");
include("login_form.php");
shop_header("Install shop header");
echo "<body>";
if (!file_exists("private/passwd"))
{
	if (!is_dir("private"))
	{
		unlink("private");
		mkdir("private");
		}
		$user[0] = array("name" => "admin", "passwd" => hash('whirlpool', "admin"), "is_admin" => 1);
		if (!file_put_contents("private/passwd", serialize($user)))
		{
			echo "erreur a la creation de l'utilisateur par default";
		exit;
			}
			}
login_form("install.php");

?>
</body>
</html>
