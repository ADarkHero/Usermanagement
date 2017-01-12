<a class="vspace" href="index.php?s=user">Nutzerübersicht</a>

<div id="login">	

	<?php if(!isset($_SESSION["username"])){ // Ist der User nicht eingeloggt, wird ihm die Möglichkeit geboten ?>

		<form action="index.php?s=login" method="post">

			<input type="text" placeholder="Username" name="username">

			<input type="password" placeholder="Passwort" name="password">

			<input type="submit" value="Login">

		</form>
		
	<?php 
		}
		else{
				echo "Eingeloggt als <strong>".$_SESSION["username"]."</strong>!";	//Ist er eingeloggt, wird ihm/ihr das angezeigt
				echo ' <a href="index.php?s=logout">Ausloggen</a>';					//Weiters wird die Möglichkeit zum Ausloggen geboten
		}

	 ?>
 
</div>