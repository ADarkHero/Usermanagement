<?php
	require_once('database.php');
	$role = getRole($pdo);
	if($role['RoleCreate'] != 1){
		header('Location: index.php'); //Hat man nicht die entsprechenden Rechte, wird man zur Indexseite zurückgeleitet
	}
?>

<h2>User anlegen</h2>

<form action="index.php?s=createuser" method="post">

<input type="text" placeholder="Username" name="username">

<input type="text" placeholder="Vorname"  name="first_name">

<input type="text" placeholder="Nachname" name="last_name">

<input type="text" placeholder="E-Mail" name="mail">

<input type="text" placeholder="Telefon" name="telephone">

<input type="password" placeholder="Passwort" name="password">

<input type="password" placeholder="Passwort wiederholen" name="password2">

<select name="role">
    <?php
		$role = getAllRoles($pdo);
		for ($i = 0; $i < sizeof($role); $i++){
			echo '<option value="'.$role[$i]['RoleID'].'">'.$role[$i]['RoleName'].'</option>';
		}
	?>
</select>

<input type="submit" value="User anlegen">
</form> 
 
 <?php
 if(isset($_POST["username"])){
	//Kundennummer wird automatisch über mySQL generiert; Die Möglichkeit zur manuellen Eingabe ließe sich natürlich auch einfach realisieren.
	$username = $_POST["username"];
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$mail = $_POST["mail"];
	$telephone = $_POST["telephone"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	$role = $_POST["role"];

	/*
		Für zusätzliche Sicherheit wird das Passwort gehashed. Ich verwende hier zur Einfachheit md5, 
		man kann natürlich auch zu noch sichereren Methoden wie sha256 greifen. Weiters kann man die
		Sicherheit durch salten und peppern des Passwortes weiter erhöhen.
	*/
	$hashed_password = md5($password);
	
	//Stimmen die eingegebenen Passwörter überein?
	if($password != $password2)
    {
		echo '<p class="warning">Die Passwörter stimmen nicht überein!</p>';
    }
	//Gab es keine Eingabefehler wird der Nutzer in die Datenbank geschrieben
	else {
		 $statement = $pdo->prepare("INSERT INTO user (UserName, UserFirstName, UserLastName, UserMail, UserTelephone, UserPassword, UserRole) 
		 VALUES (?, ?, ?, ?, ?, ?, ?)");
		 $result = $statement->execute([$username, $first_name, $last_name, $mail, $telephone, $hashed_password, $role]);
		 
		if($result)
			{
				echo "Der Benutzer <b>$username</b> wurde erstellt.";
			}
		else
			{
				echo '<p class="warning">Fehler beim Speichern des Benutzers. Bitte versuchen Sie es erneut oder kontaktieren sie einen Systemadministator.</p>';
			}

	}
 }
?> 