<?php

include("shop_header.php");
include("admin_pane.php");
shop_header("Shop Administration");

?>
<?php admin_left() ?>
<div class='window'>
	<?php
		$tab = unserialize(file_get_contents("private/passwd"));
		if (is_array($tab)) {
			foreach($tab as $user) {
				if (isset($user['commands'])) {
					echo "<table><tr><td>".$user['login']."</td></tr>";
					$i = 0;
					while ($i < count($user['commands'])) {
						echo "<tr><td>Commande ".$i."</td>";
						echo "<td><table>";
						foreach($user['commands'][$i]['cart']['items'] as $item) {
							echo "<tr><td>".$item['name']."</td><td>".$item['quantity']."</td><td>".$item['price']."</td><td>".$item['sub_total']."</td></tr>";
						}
						$i++;
						echo "</table></td>";
					}
					echo "</table>";
				}
			}
		}
	?>
</div>
<?php admin_right() ?>
