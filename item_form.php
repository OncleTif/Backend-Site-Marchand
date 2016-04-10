<?php
function item_form($ref, $item, $action)
{
	echo "<form action='".$action."' method='post'>";
	echo "<p>Article : ".$item['name']."</p>";
	echo "<p>Prix : ".$item['price']."€</p>";
	echo "<input type='hidden' name='ref' value='".$ref."'>";
	echo "<input type='hidden' name='form' value='add_to_cart'>";
	echo "Quantite : <input type='number' name='quantity' value='1' max='".$item["number"]."'>";
	echo"<br />";
	echo "<input type='submit' value='Ajouter au panier'>";
 echo "</form>";
	}
?>
