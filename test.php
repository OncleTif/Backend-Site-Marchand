<?php

function add_item($num, $tab, $POST)
{
	$tab['item'][$num]['name'] = $POST['name'];
	if (array_key_exists('ref', $tab['item'][$num]) === FALSE)
		$tab['item'][$num]['ref'] = $tab['item'][$num]['name'];
	$tab['item'][$num]['price'] = $POST['price'];
	$tab['item'][$num]['number'] = $POST['number'];
	$tab['item'][$num]['category'] = array();
	foreach($tab['cat'] as $cat) {
		if (array_key_exists($cat, $POST)) {
			$tab['item'][$num]['category'][] = $cat;
		}
	}
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR file_put_contents add\n";
	}
}

function add_category($num, $tab, $category)
{
	$tab['cat'][$num] = $category;
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR\n";
	}
}

$tab = array('cat' => array(), 'item' => array());
add_category(0, $tab, 'visserie');
$tab = unserialize(file_get_contents("private/item"));
add_category(1, $tab, 'outils');
$tab = unserialize(file_get_contents("private/item"));
add_category(2, $tab, 'petit outillage');

$tab = unserialize(file_get_contents("private/item"));
add_item(0, $tab, array('name' => 'vis', 'price' => 3, 'number' => 500, 'visserie' => 1));
$tab = unserialize(file_get_contents("private/item"));
add_item(1, $tab, array('name' => 'tournevis', 'price' => 50, 'number' => 5, 'outils' => 1));
$tab = unserialize(file_get_contents("private/item"));
add_item(2, $tab, array('name' => 'clou', 'price' => 2, 'number' => 1000, 'petit outillage' => 1, 'visserie' => 1));
$tab = unserialize(file_get_contents("private/item"));
add_item(3, $tab, array('name' => 'marteau', 'price' => 60, 'number' => 7, 'outils' => 1));
$tab = unserialize(file_get_contents("private/item"));
print_r($tab);

?>
