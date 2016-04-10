<?php

function add_item($num, $tab, $POST)
{
	$tab['item'][$num]['name'] = $POST['name'];
	$tab['item'][$num]['category'] = $POST['category'];
	$tab['item'][$num]['price'] = $POST['price'];
	$tab['item'][$num]['number'] = $POST['number'];
	$tab['item'][$num]['category'] = array();
	foreach($tab['cat'] as $cat) {
		if (array_key_exists($cat, $POST)) {
			$tab['item'][$num]['category'][] = $cat;
		}
	}
	print_r($tab['item'][$num]['category']);
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR file_put_contents add\n";
	}
}

function del_item($tab, $num)
{
	$i = 0;
	$new = array();
	while (isset($tab['item'][$i])) {
		if ($i !== $num) {
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

if ($_POST['name'] != NULL && $_POST['price'] != NULL && $_POST['number'] != NULL
	&& $_POST['submit'] === "OK") {
	if (file_exists("private/item") === FALSE) {
		$tab = array('cat' => array(), 'item' => array());
	} else {
		$content = file_get_contents("private/item");
		$tab = unserialize($content);
		if (is_array($tab)) {
			$i = 0;
			while (isset($tab['item'][$i])) {
				if ($tab['item'][$i]['name'] === $_POST['name']) {
					break ;
				}
				$i++;
			}
		} else {
			if (file_put_contents("private/item_corrupt".time(), $content) === FALSE) {
				echo "ERROR file_put_contents\n";
			}
			$tab = array('cat' => array(), 'item' => array());
		}
	}
	add_item($i, $tab, $_POST);
} else if ($_POST['name'] != NULL && $_POST['submit'] === "DEL") {
	if (file_exists("private/item") === TRUE) {
		$content = file_get_contents("private/item");
		$tab = unserialize($content);
		if (is_array($tab)) {
			$i = 0;
			while (isset($tab['item'][$i])) {
				if ($tab['item'][$i]['name'] === $_POST['name']) {
					del_item($tab, $i);
					break ;
				}
				$i++;
			}
		}
	}
} else {
	foreach($_POST as $key => $val) {
		echo $key." => ".$val."<br />";
	}
	echo "ERROR post\n";
}

?>
