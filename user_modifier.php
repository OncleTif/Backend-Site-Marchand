<?php
function user_modifier($new_pwd)
{
$tab = unserialize(file_get_contents("private/passwd"));
if (is_array($tab))
{
	foreach ($tab as $key => $user)
	{
		if ($user["login"] === $login)
		{
		$tab[$key]["passwd"] = hash('whirlpool', $new_pwd);
		}
	}
	if (file_put_contents("private/passwd", serialize($tab)))
	{
		echo "<p>Modification du compte '".$_SESSION["loggued_on_user"]."' bien prise en compte</p>";
		}
	else
	echo "<p class='error'>Erreur à l'écriture du fichier de mot de passe</p>";
	}
else
	echo "<p class='error'>Erreur sur le fichier de mot de passe</p>";
}
?>
