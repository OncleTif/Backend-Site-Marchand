<?php
function modif_cart($input)
{
	if (file_exists("private/item"))
	{
$tab = unserialize(file_get_contents("private/item"));
if (is_array($tab) && is_array($tab["item"]) )
{
$items = $tab["item"];
$_SESSION["cart"]["total"] = $_SESSION["cart"]["total"] - $_SESSION["cart"]["items"][$input["ref"]]["sub_total"];
	$_SESSION["cart"]["items"][$input['ref']]['name'] = $items[$input['ref']]["name"];
	$_SESSION["cart"]["items"][$input['ref']]['price'] = $items[$input['ref']]["price"];
	$_SESSION["cart"]["items"][$input['ref']]['quantity'] = $input['quantity'];
	$_SESSION["cart"]["items"][$input['ref']]['price'] = $items[$input['ref']]["price"];
	$_SESSION["cart"]["items"][$input['ref']]['sub_total'] = $items[$input['ref']]["price"] * $input["quantity"];
$_SESSION["cart"]["total"] = $_SESSION["cart"]["total"] + $_SESSION["cart"]["items"][$input["ref"]]["sub_total"];
}
}
}
