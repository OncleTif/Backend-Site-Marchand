<?php

function add_cat($tab, $POST) {
	$tab['cat'][$POST['ref']]['name'] = $POST['name'];
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
	foreach($tab['item'] as $item) {
		$i = 0;
		$new_cat = array();
		while ($i < count($item['cat'])) {
			if ($item['cat'][$i] != $ref) {
				$new_cat[] = $item['cat'][$i];
			}
			$i++;
		}
		$item['cat'] = $new_cat;
	}
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR file_put_contents del\n";
	}
}

if ($_POST['name'] != NULL && $_POST['submit'] === "OK") {
	if (file_exists('private/item') === FALSE) {
		$tab = array('cat' => array(), 'item' => array());
		$_POST['ref'] = 0;
	} else {
		$tab = unserialize(file_get_contents("private/item"));
		if (is_array($tab)) {
			if (isset($_POST['ref']) === FALSE)
				$_POST['ref'] = count($tab['cat']);
		} else {
			if (file_put_contents("private/category_corrupt".time(), $content) === FALSE) {
				echo "ERROR\n";
			}
			$tab = array('cat' => array(), 'item' => array());
			$_POST['ref'] = 0;
		}
		add_cat($tab, $_POST);
	}

} else if ($_POST['ref'] && $_POST['submit'] === 'DEL') {
	if (file_exists('private/item') === TRUE) {
		$tab = unserialize(file_get_contents("private/item"));
		if (is_array($tab)) {
			del_cat($tab, $_POST['ref']);
		}
		if (file_put_contents("private/item", serialize($tab)) === FALSE) {
			echo "ERROR\n";
		}
	}
}

?>
