<?php
function item_form($ref, $item, $action)
{
	echo "<form action='".$action."' method='post'>";
	echo "<p>".$item['name']."</p>";
	echo "<p>".$item['price']."€</p>";
	echo "<input type='hidden' name='ref' value='".$ref."'>";
	echo "<input type='number' name='quantity' value='1' max='".$item["number"]."'>";
	echo "<input type='submit' value='Ajouter au panier'>";
 echo "</form>";
	}
?>
