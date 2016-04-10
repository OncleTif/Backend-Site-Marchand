<?php
function home_form($action)
{
	echo '<form action="'.$action.'" method="POST">
		<input type="hidden" method="post" name="form" value="home"/>
		<input type="submit" name="submit" value="Home" />
		</form>';
}
?>
