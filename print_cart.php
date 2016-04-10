<?
if (isset($_SESSION["cart"]))
{
foreach ($_SESSION["cart"]["items"] as $item_cart)
{
	echo "<div class='item_cart'>";
	echo "<p>".$item_cart["name"]."</p>";
	echo "<p>".$item_cart["price"]."</p>";
	echo "<p>".$item_cart["quantity"]."</p>";
	echo "<p>".$item_cart["sub_price"]."</p>";
	}
	echo "</div>";
	echo "<p>".$_SESSION["cart"]["total"]."</p>";
	}
?>
