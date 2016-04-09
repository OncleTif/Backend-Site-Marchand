<?PHP

function auth($login, $passwd)
{
	if (file_exists("private/passwd") === TRUE) {
		$content = file_get_contents("private/passwd");
		$tab = unserialize($content);
		$i = 0;
		while (isset($tab[$i])) {
			if ($tab[$i]['login'] === $login && $tab[$i]['passwd'] === hash("whirlpool", $passwd)) {
				break ;
			}
			$i++;
		}
		if (isset($tab[$i]) === TRUE) {
			return (array(TRUE, $tab[$i]['is_admin']));
		} else {
			return array(FALSE, 0);
		}
	} else {
		return array(FALSE, 0);
	}
}

?>
