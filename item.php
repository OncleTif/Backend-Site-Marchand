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
			$tab = unserialize($content);
			if (is_array($tab)) {
				admin_left();
				echo "<div class='window'>";
				echo "<table><tr>";
				echo "<td>nom</td>";
				echo "<td>categorie</td>";
				echo "<td>prix</td>";
				echo "<td>nombre</td></tr>";
				foreach($tab['item'] as $item) {
					echo 	"<tr><form action='add_item.php' method='POST'>";
					foreach($item as $key => $val) {
						// if (is_array($val)) {
						//
						// } else {
							echo "<td><input type='text' name=".$key." value=".$val." /></td>";
						// }
					}
					echo 		"<td><input type='submit' name='submit' value='OK' method='POST' /></td>
								<td><input type='submit' name='submit' value='DEL' method='POST' /></td>
							</form></tr>";
				}
				echo "<tr><form action='add_item.php' method='POST'>";
				echo "<td><input type='text' name='name' value='' /></td>";
				echo "<td><input type='text' name='category' value='' /></td>";
				echo "<td><input type='text' name='price' value='' /></td>";
				echo "<td><input type='text' name='number' value='' /></td>";
				echo "<td><input type='submit' name='submit' value='OK' method='POST' /></td>";
				echo "</form></tr></table>";
				echo "<br /><br /><br />";
				echo "<table><tr>";
				echo "<td>nom</td>";
				foreach($tab['cat'] as $cat) {
					echo "<tr><form action='add_category.php' method='POST'>";
					echo "<td><input type='text' name='category' value='".$cat."' /></td>";
					echo "<td><input type='submit' name='submit' value='DEL' method='POST' /></td></from></tr>";
				}
				echo "<tr><form action='add_category.php' method='POST'>";
				echo "<td><input type='text' name='category' value='' /></td>";
				echo "<td><input type='submit' name='submit' value='OK' method='POST' /></td></from></tr>";
				echo "</table>";
				echo "</div>";
				admin_right();
			} else {
				if (file_put_contents("private/item_corrupt".time(), $content) === FALSE) {
					echo "ERROR\n";
				}
				$tab = array();
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
