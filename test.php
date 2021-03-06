<?php

function add_item($tab, $POST) {
	$tab['item'][$POST['ref']]['name'] = $POST['name'];
	$tab['item'][$POST['ref']]['price'] = $POST['price'];
	$tab['item'][$POST['ref']]['number'] = $POST['number'];
	if (isset($tab['item'][$POST['ref']]['sold']) === FALSE)
		$tab['item'][$POST['ref']]['sold'] = 0;
	$tab['item'][$POST['ref']]['cat'] = array();
	foreach($tab['cat'] as $ref => $value) {
		if (array_key_exists($value, $POST)) {
			$tab['item'][$POST['ref']]['cat'][] = $ref;
		}
	}
	if (file_put_contents("private/item", serialize($tab)) === FALSE) {
		echo "ERROR\n";
	}
}

function del_cat($tab, $ref) {
	$new = array();
	$i = 0;
	while ($i < count($tab['cat'])) {
		if ($i != $ref) {
			$new[] = $tab['cat'][$i];
		}
		$i++;
	}
	$tab['cat'] = $new;
	$j = 0;
	while ($j < count($tab['item'])) {
		$i = 0;
		$new_cat = array();
		while ($i < count($tab['item'][$j]['cat'])) {
			echo $tab['item'][$j]['cat'][$i]." ".$ref."\n";
			if ($tab['item'][$j]['cat'][$i] !== $ref) {
				echo "different\n";
				$new_cat[] = $tab['item'][$j]['cat'][$i];
			}
			$i++;
		}
		$tab['item'][$j]['cat'] = $new_cat;
		$j++;
	}
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR file_put_contents del\n";
	}
}

function del_item($tab, $ref) {
	$new = array();
	$i = 0;
	while ($i < count($tab['item'])) {
		if ($i != $ref) {
			$new[] = $tab['item'][$i];
		}
		$i++;
	}
	$tab['item'] = $new;
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR file_put_contents del\n";
	}
}

function add_cat($tab, $POST) {
	$tab['cat'][$POST['ref']] = $POST['name'];
	if (file_put_contents("private/item", serialize($tab)) === FALSE) {
		echo "ERROR\n";
	}
}

$tab = array('cat' => array(), 'item' => array());
add_cat($tab, array('ref' => 0, 'name' => 'visserie'));
$tab = unserialize(file_get_contents("private/item"));
add_cat($tab, array('ref' => 1, 'name' => 'outils'));
$tab = unserialize(file_get_contents("private/item"));
add_cat($tab, array('ref' => 2, 'name' => 'petit outillage'));
$tab = unserialize(file_get_contents("private/item"));

add_item($tab, array('ref' => 0, 'name' => 'vis', 'price' => 3, 'number' => 500, 'visserie' => 1));
$tab = unserialize(file_get_contents("private/item"));
add_item($tab, array('ref' => 1, 'name' => 'tournevis', 'price' => 50, 'number' => 5, 'outils' => 1));
$tab = unserialize(file_get_contents("private/item"));
add_item($tab, array('ref' => 2, 'name' => 'clou', 'price' => 2, 'number' => 1000, 'petit outillage' => 1, 'visserie' => 1));
$tab = unserialize(file_get_contents("private/item"));
add_item($tab, array('ref' => 3, 'name' => 'marteau', 'price' => 60, 'number' => 7, 'outils' => 1));

// del_cat($tab, 0);

?>
