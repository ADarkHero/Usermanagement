<?php
	require_once('database.php');
	$role = getRole($pdo);
	if($role['RoleDelete'] != 1){
		header('Location: index.php'); //Hat man nicht die entsprechenden Rechte, wird man zur Indexseite zurückgeleitet
	}
	
	
	$statement = $pdo->prepare("DELETE FROM user WHERE UserID = :id");
	$statement->bindParam(':id', $_GET["id"], PDO::PARAM_INT);   
	$statement->execute();
	
	if($statement){
		echo "User erfolgreich gelöscht!";
		header('Location: index.php');
	}
	else{
		echo 'Fehler beim Löschen des Benutzers. Bitte versuchen Sie es erneut oder kontaktieren sie einen Systemadministator. <a href="index.php?user">Zurück</a>';
	}
?>