<?php
	require_once('database.php');
	$role = getRole($pdo);
	if($role['RoleEdit'] != 1){
		header('Location: index.php'); //Hat man nicht die entsprechenden Rechte, wird man zur Indexseite zurückgeleitet
	}
	
	
	//Informationen von User einlesen
	$statement = $pdo->prepare("SELECT * FROM user WHERE UserID =:userID");
	$statement->bindValue(':userID', $_GET["id"]);
	$statement->execute();
	$user = $statement->fetchAll();
?>

<h2>User editieren</h2>

<form action="index.php?s=edituser&id=<?php echo $_GET["id"]; ?>" method="post">

<input type="text" name="username" placeholder="Username" value="<?php echo $user[0]['UserName']; ?>">

<input type="text" name="first_name" placeholder="Vorname" value="<?php echo $user[0]['UserFirstName']; ?>">

<input type="text" name="last_name" placeholder="Nachname" value="<?php echo $user[0]['UserLastName']; ?>">

<input type="text" name="mail" placeholder="E-Mail" value="<?php echo $user[0]['UserMail']; ?>">

<input type="text" name="telephone" placeholder="Telefon" value="<?php echo $user[0]['UserTelephone']; ?>">

<input type="password" placeholder="Neues Passwort (Leer lassen, um keine Änderungen durchzuführen)" name="password">

<input type="password" placeholder="Neues Passwort wiederholen" name="password2">

<select name="role">
    <?php
		$role = getAllRoles($pdo);
		for ($i = 0; $i < sizeof($role); $i++){
			if($user[0]['UserRole'] == $role[$i]['RoleID']){
				echo '<option value="'.$role[$i]['RoleID'].'" selected>'.$role[$i]['RoleName'].'</option>';
			}
			else {
				echo '<option value="'.$role[$i]['RoleID'].'">'.$role[$i]['RoleName'].'</option>';
			}
		}
	?>
</select>

<input type="submit" value="User ändern">
</form> 


<?php
	//Hier wird der User geupdated, nachdem der Button gedrückt wurde
	if(isset($_POST["username"])){
		
		//Soll das Passwort geupdated werden?
		if($_POST["password"] != ""){
			$hashed_password = md5($_POST["password"]);
			
			if($_POST["password"] == $_POST["password2"]){
				$statement = $pdo->prepare("UPDATE user SET UserPassword=:password WHERE UserName=:username");
				$statement->bindParam(':password', $hashed_password);   
				$statement->bindParam(':username', $_POST["username"]);   
				$statement->execute();
				echo 'Passwort geändert!';
			}
			else{
				echo '<p class="warning">Die Passwörter stimmen nicht überein!</p>';
				exit;
			}
		}
		
		$statement = $pdo->prepare("UPDATE user SET UserName=:username, UserFirstName=:firstname, UserLastName=:lastname, UserMail=:mail, UserTelephone=:telephone, UserRole=:role WHERE UserName=:username");
		$statement->bindParam(':username', $_POST["username"]);     
		$statement->bindParam(':firstname', $_POST["first_name"]);     
		$statement->bindParam(':lastname', $_POST["last_name"]);     
		$statement->bindParam(':mail', $_POST["mail"]);     
		$statement->bindParam(':telephone', $_POST["telephone"]);     
		$statement->bindParam(':role', $_POST["role"]);     
		$statement->execute();
		header('Location: index.php?s=edituser&id='.$_GET["id"]);
		
		//Ich schreibe hier selbst unveränderte Werte neu in die Datenbank -> ineffizient; Man sollte bei jedem Wert abfragen, ob er verändert wurde
	}
?>