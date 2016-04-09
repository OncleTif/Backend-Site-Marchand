<?PHP
include "auth.php";

session_start();
$_SESSION['loggued_on_user'] = "";
if (isset($_POST["login"]) && isset($_POST["passwd"])) {
	if (auth($_POST['login'], $_POST['passwd']) === TRUE) {
		$_SESSION['loggued_on_user'] = $_POST['login'];
		echo "	<html><body>
					<iframe name='chat' src='chat.php' width='100%' height='550px'></iframe>
					<iframe name='speak' src='speak.php' width='100%' height='50px'></iframe>
					<br />
					<form action='logout.php'>
					<input type='submit' name='submit' value='D&eacute;connexion' method='POST' />
					<form>
				</body></html>";
	} else {
		echo "ERROR\n";
	}
} else {
	echo "ERROR\n";
}

?>
