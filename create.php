<?PHP

function add_user($num, $tab, $login, $passwd)
{
	header("Location: index.php");
	$tab[$num]['login'] = $login;
	$passwd = hash("whirlpool", $passwd);
	$tab[$num]['passwd'] = $passwd;
	$tab[$num]['is_admin'] = 0;
	$content = serialize($tab);
	file_put_contents("private/passwd", $content);
	echo "OK\n";
}

if (file_exists("private/passwd")) {
	header("Location: create.html");
	if ($_POST['passwd'] != NULL && $_POST['login'] != NULL && $_POST['submit'] === "OK") {
		$content = file_get_contents("private/passwd");
		$tab = unserialize($content);
		$i = 0;
		while (isset($tab[$i])) {
			if ($tab[$i]['login'] === $_POST['login']) {
				break ;
			}
			$i++;
		}
		if (isset($tab[$i]) === FALSE) {
			add_user($i, $tab, $_POST['login'], $_POST['passwd']);
		} else {
			echo "ERROR\n";
		}
	} else {
		echo "ERROR\n";
	}
} else {
	header("Location: install.php");
}

?>
