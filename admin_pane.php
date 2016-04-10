<?php

function admin_left()
{
	echo	"<body>
				<div class='container'>
					<div class='category_list'>
						<form action='user.php'>
							<input type='submit' name='Modification Utilisateurs' value='Modification Utilisateurs' method='POST' />
						</form>
						<form action='item.php'>
							<input type='submit' name='Modification Articles' value='Modification Articles' method='POST' />
						</form>
					</div>";
}

function admin_right()
{
	echo				"<div class='login'>
							<form action='logout.php' method='POST'>
								<input type='submit' name='submit' value='D&eacute;connexion' />
							</form>
						</div>
					</div>
				</body>
			</html>";
}

?>
