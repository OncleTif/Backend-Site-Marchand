<?php

function add_item($num, $tab, $item, $category, $price, $number, $promotion)
{
	$tab[$num]['item'] = $item;
	$tab[$num]['category'] = $category;
	$tab[$num]['price'] = $price;
	$tab[$num]['number'] = $number;
	$tab[$num]['promotion'] = $promotion;
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR\n";
	}
}

function del_item($tab, $num)
{
	$i = 0;
	$new = array();
	while (isset($tab[$i])) {
		if ($i !== $num) {
			$new[] = $tab[$i]
		}
		$i++;
	}
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR\n";
	}
}

if ($_POST['item'] != NULL && $_POST['category'] != NULL && $_POST['price'] != NULL
	&& $_POST['number'] != NULL && $_POST['submit'] === "OK") {
	$i = 0;
	if (file_exists("private/item") === FALSE) {
		$tab = array();
	} else {
		$content = file_get_contents("private/item");
		$tab = unserialize($content);
		if (is_array($tab)) {
			while (isset($tab[$i])) {
				if ($tab[$i]['item'] === $_POST['item']) {
					break ;
				}
				$i++;
			}
		} else {
			if (file_put_contents("private/item_corrupt".time(), $content) === FALSE) {
				echo "ERROR\n";
			}
			$tab = array();
		}
	}
	add_item($i, $tab, $_POST['item'], $_POST['category'], $_POST['price'],
		$_POST['number'], $_POST['promotion']);
} else if ($_POST['item'] != NULL && $_POST['submit'] === "DEL") {
	if (file_exists("private/item") === TRUE) {
		$content = file_get_contents("private/item");
		$tab = unserialize($content);
		if (is_array($tab)) {
			while (isset($tab[$i])) {
				if ($tab[$i]['item'] === $_POST['item']) {
					del_item($tab, $i);
					break ;
				}
				$i++;
			}
		}
	}
} else {
	echo "ERROR\n";
}

?>
