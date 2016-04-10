<?php
function modify_privileges($tab_admin)
{
$tab = unserialize(file_get_contents("private/passwd"));
if (is_array($tab))
{

}
else
	echo "<p class='error'>Erreur sur le fichier de mot de passe</p>";

}
?>
