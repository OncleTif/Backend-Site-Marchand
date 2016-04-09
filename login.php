<?PHP
include "auth.php";

session_start();
$_SESSION['loggued_on_user'] = "";
if (isset($_GET["login"]) && isset($_GET["passwd"])) {
	if (auth($_GET['login'], $_GET['passwd']) === TRUE) {
		$_SESSION['loggued_on_user'] = $_GET['login'];
		echo "OK\n";
	} else {
		echo "ERROR\n";
	}
} else {
	echo "ERROR\n";
}

?>
