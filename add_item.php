<?php

function add_item($num, $tab, $item, $category, $price, $number, $promotion)
{
	$tab[$num]['item'] = $item;
	$tab[$num]['category'] = $category;
	$tab[$num]['price'] = $price;
	$tab[$num]['number'] = $number;
	$tab[$num]['promotion'] = $promotion;
	$content = serialize($tab);
	file_put_contents("private/category", $content);
}

if ($_POST['item'] != NULL && $_POST['category'] != NULL && $_POST['price'] != NULL
	&& $_POST['number'] != NULL && $_POST['submit'] === "OK") {
	$i = 0;
	if (file_exists("private/item") === FALSE) {
		$tab = array();
		if (file_exists("private") === FALSE) {
			mkdir("private");
		}
	} else {
		$content = file_get_contents("private/item");
		$tab = unserialize($content);
		while (isset($tab[$i])) {
			if ($tab[$i]['item'] === $_POST['item']) {
				break ;
			}
			$i++;
		}
	}
	add_item($i, $tab, $_POST['item'], $_POST['category'], $_POST['price',
		$_POST['number'], $_POST['promotion']);
} else {
	echo "ERROR\n";
}

?>
