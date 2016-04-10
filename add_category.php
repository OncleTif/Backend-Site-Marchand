<?php

function add_category($num, $tab, $category)
{
	$tab['cat'][$num] = $category;
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR\n";
	}
}

function del_category($tab, $num)
{
	$i = 0;
	$new = array();
	while (isset($tab['cat'][$i])) {
		if ($i !== $num) {
			$new[] = $tab['cat'][$i];
		}
		$i++;
	}
	$tab['cat'] = $new;
	$content = serialize($tab);
	if (file_put_contents("private/item", $content) === FALSE) {
		echo "ERROR\n";
	}
}

echo "POST: ".$_POST['category']." ".$_POST['submit']."\n";

if ($_POST['category'] != NULL && $_POST['submit'] === "OK") {
	$i = 0;
	if (file_exists("private/item") === FALSE) {
		$tab = array('cat' => array(), 'item' => array());
	} else {
		$content = file_get_contents("private/item");
		$tab = unserialize($content);
		if (is_array($tab)) {
			while (isset($tab['cat'][$i])) {
				if ($tab['cat'][$i] === $_POST['category']) {
					break ;
				}
				$i++;
			}
		} else {
			if (file_put_contents("private/category_corrupt".time(), $content) === FALSE) {
				echo "ERROR\n";
			}
			$tab = array('cat' => array(), 'item' => array());
		}
	}
	add_category($i, $tab, $_POST['category']);
} else if ($_POST['category'] != NULL && $_POST['submit'] === "DEL") {
	if (file_exists("private/category") === TRUE) {
		$content = file_get_contents("private/category");
		$tab = unserialize($content);
		if (is_array($tab)) {
			$i = 0;
			while (isset($tab['cat'][$i])) {
				if ($tab['cat'][$i] === $_POST['category']) {
					del_item($tab, $i);
					break ;
				}
				$i++;
			}
		}
	}
} else {
	echo "marche pas\n";
	echo "ERROR\n";
}
