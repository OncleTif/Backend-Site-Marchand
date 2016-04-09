<?PHP

function add_user($num, $tab, $login, $passwd)
{
	header("Location: http://e2r7p1.42.fr:8080/j04/ex04/index.html");
	$passwd = hash("whirlpool", $passwd);
	$tab[$num]['passwd'] = $passwd;
	$content = serialize($tab);
	file_put_contents("../private/passwd", $content);
	echo "OK\n";
}

header("Location: http://e2r7p1.42.fr:8080/j04/ex04/modif.html");
if ($_POST['oldpw'] != NULL && $_POST['newpw'] != NULL && $_POST['login'] != NULL && $_POST['submit'] === "OK") {
	if (file_exists("../private/passwd") === TRUE) {
		$content = file_get_contents("../private/passwd");
		$tab = unserialize($content);
		$i = 0;
		while (isset($tab[$i])) {
			if ($tab[$i]['login'] === $_POST['login'] && $tab[$i]['passwd'] === hash("whirlpool", $_POST['oldpw'])) {
				break ;
			}
			$i++;
		}
		if (isset($tab[$i]) === TRUE) {
			add_user($i, $tab, $_POST['login'], $_POST['newpw']);
		} else {
			echo "ERROR\n";
		}
	} else {
		echo "ERROR\n";
	}
} else {
	echo "ERROR\n";
}

?>
