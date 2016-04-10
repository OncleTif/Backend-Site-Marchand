<?php
session_start();
include("shop_header.php");
include("login_form.php");
include("auth.php");
include("admin_pane.php");

if (file_exists("private/passwd")) {
	shop_header("Administration des Items");
	if (!$SESSION["loggued_on_user"] && $_POST["login"] != "" && $_POST["passwd"] != "") {
		$_SESSION = array_merge($_SESSION, auth($_POST["login"], $_POST["passwd"]));
	}
	if ($_SESSION["loggued_on_user"] && $_SESSION["is_admin"]) {
		if (file_exists("private/item") === TRUE) {
			$content = file_get_contents("private/item");
			$tab_item = unserialize($content);
			if (is_array($tab_item)) {
				admin_left();
				echo "<div class='window'>";
				foreach($tab_item as $item) {
					echo 	"<div><form action='add_item.php' method='POST'>";
					foreach($item as $key => $val) {
						// if (is_array($val)) {
						// 	echo "<input type='checkbox' name=".$key." value='category' checked />";
						// } else {
							echo "<input type='text' name=".$key." value=".$val.">";
						// }
					}
					echo 		"<input type='submit' name='submit' value='OK' method='POST' />
								<input type='submit' name='submit' value='DEL' method='POST' />
							</form></div>";
				}
				echo "<div><form action='add_item.php' method='POST'>";
				echo "<input type='text' name='item' value=''>";
				echo "<input type='text' name='category' value=''>";
				echo "<input type='text' name='price' value=''>";
				echo "<input type='text' name='number' value=''>";
				echo "<input type='text' name='promotion' value=''>";
				echo "<input type='submit' name='submit' value='OK' method='POST' />";
				echo "</form></div>";
				echo "</div>";
				admin_right();
			} else {
				if (file_put_contents("private/item_corrupt".time(), $content) === FALSE) {
					echo "ERROR\n";
				}
				$tab_item = array();
			}
		}
	} else {
		login_form($_SERVER['PHP_SELF']);
	}
} else {
	header("Location: install.php");
}
?>
</body></html>
