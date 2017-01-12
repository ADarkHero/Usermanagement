<?php
	/* 	Wenn der User die eingegebenen Login-Daten abschickt, wird dieses Script aufgerufen
		Hier werden Username und Passwort überprüft und der User wird eingeloggt, wenn alles korrekt war
	*/
	
	if(isset($_POST["username"]) && isset($_POST["password"])){
		require_once('database.php'); //Verbindung zur Datenbank wird hergestellt

		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$hashed_password = md5($password);
				
		$statement = $pdo->prepare("SELECT * FROM user WHERE UserName = '".$username."'");
		$result = $statement->execute(array('UserName' => $username));
		$user = $statement->fetch();		

		//Nutzer vorhanden?
		if($user == false){
			echo '<p class="warning">Falscher Nutzername!</p>';
		}
		//Passwort korrekt?
		else if($hashed_password !== $user['UserPassword']){
			echo '<p class="warning">Falsches Passwort!</p>';
		}
		else{
			$_SESSION["username"] = $user['UserName'];
			$_SESSION["password"] = $user['UserPassword'];	//Wird in der Aufgabenstellung verlangt. Man sollte sein Passwort NICHT in der Session speichern -> Sicherheitslücke; Session Hijacking
			$_SESSION["role"] = $user['UserRole'];			/*  Im abgesicherten Bereich ist die Rolle am Wichtigsten. 
																Sie gibt an, welche Rechte der Nutzer hat. Die Rollen ID wird als Hash gespeichert,
																damit ein potentieller Hacker nicht seine Rolle während der Session ändern kann.
															*/
			
			header('Location: index.php?s=user'); //Weiterleitung auf Userübersicht, wenn Anmeldung erfolgreich
		}
		
		
	}
	
	
	include 'user.php';
?>