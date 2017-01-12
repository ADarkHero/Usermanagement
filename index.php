<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Zugangsgeschützter Administrationsbereich zum Bearbeiten von Nutzeraccounts</title>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
<body>

<div id="head">
	<?php 
		include 'head.php'; 
	?>
</div>

<div id="main">
<?php	
	

	/*	Die Seite, auf der sich der User derzeit befindet wird über einen GET Befehl übertragen.
		Hier wird ausgelesen, welche Seite dies ist. Befindet er sich auf der "normalen" index.php
		Seite (ohne ein GET) wird ihm/ihr die Nutzerliste angezeigt.
	*/
	if(isset($_GET["s"])){
		include $_GET["s"].'.php';
	}
	else{
		include 'user.php';
	}	
		
?>
</div>


</body>