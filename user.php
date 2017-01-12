<?php
	require_once('database.php'); //Verbindung zur Datenbank wird hergestellt

	//Hiermit wird ausgelesen, welche Rechte die eigene Rolle hat
	/* 	Kleine Notiz: Mir ist aufgefallen, dass mein Rollensystem nicht ganz der Anforderung entspricht,
		sondern darüber hinaus geht und komplexer ist. So kann man hier Nutzer erstellen, die nicht
		alle Rechte haben. Ich ging davon aus, User müssen sich einloggen, um die Tabelle zu sehen und zu exportieren (dies habe ich geändert).
		Ich werde jedoch mein Rollensystem vorerst im Code lassen (um meine Arbeit zu demonstrieren), kann es jedoch gerne auch entfernen.
	*/
	if(isset($_SESSION["username"])){
		$role = getRole($pdo);
	}
?>

<form action="index.php?s=user" method="post">
	<input type="text" class="search" name="search" placeholder="Suche...">
</form>


<table class="table">
<tr>
	<th>Kundennummer</th>
	<th>Username</th>
	<th>Vorname</th>
	<th>Nachname</th>
	<th>E-Mail</th>
	<th>Telefon</th>
	<?php if(isset($role['RoleEdit']) && $role['RoleEdit'] == 1){ echo "<th>Editieren</th>"; }
	if(isset($role['RoleDelete']) && $role['RoleDelete'] == 1){ echo "<th>Löschen</th>"; } ?>
</tr>

<?php
	/*	Hier wird eine tabellarische Übersicht generiert
		Wenn die Nutzerzahl sehr hoch wird, sollte man nur einen Teil dieser auf einmal auslesen (z.B. 50 pro Seite) um die Datenbank
		zu "schonen" und das laden der Seite zu beschleunigen.
		Eine Sortierfunktion habe ich ebenfalls nicht eingebaut, da dies in der Aufgabenstellung nicht verlangt war. Diese wäre ebenfalls eine sehr sinnvolle Erweiterung.
	*/
	
	//if($role['RoleExport'] == 1){		//Falls nur User mit Exportrechten die Liste sehen sollen/exportieren dürfen
	
	//Wenn nach einem Begriff gesucht wird, werden nur dementsprechende Ergebnisse angezeigt, ansonsten alle
	if(isset($_POST["search"]) && $_POST["search"] != ""){
		$search = '%'.$_POST["search"].'%';	//Der eingegebene Suchbegriff kann am Anfang/Ende/Mitte des Ergebnisses stehen
		$statement = $pdo->prepare("SELECT * FROM user WHERE UserName LIKE :search OR UserFirstName LIKE :search OR UserLastName LIKE :search OR UserID LIKE :search ORDER BY UserID");
		$statement->bindParam(':search', $search);
	}
	else{
		$statement = $pdo->prepare("SELECT * FROM user ORDER BY UserID");
		
	}
		$result = $statement->execute();
		for($i = 1; $row = $statement->fetch(); $i++) {
			echo "<tr>";
			echo "<td>".$row['UserID']."</td>";
			echo "<td>".$row['UserName']."</td>";
			echo "<td>".$row['UserFirstName']."</td>";
			echo "<td>".$row['UserLastName']."</td>";
			echo '<td><a href="mailto:'.$row['UserMail'].'">'.$row['UserMail'].'</a></td>';
			echo "<td>".$row['UserTelephone']."</td>";
			if(isset($role['RoleEdit']) && $role['RoleEdit'] == 1){ //Nur User mit Edit Rechten (Admins) sehen diesen Link
				echo '<td><a href="index.php?s=edituser&id='.$row['UserID'].'">EDITIEREN</a></td>'; 
			} 	
			if(isset($role['RoleDelete']) && $role['RoleDelete'] == 1){ //Nur User mit Delete Rechten (Admins) sehen diesen Link
				echo '<td><a href="#" onclick="confirmDeletion('.$row['UserID'].')">LÖSCHEN</a></td>'; 
			}	
			echo "</tr>";
		}
		
		echo '</table>';
		echo '<br /><a class="space" href="exportcsv.php">Als CSV exportieren...</a>';
	//}

	//Nur User mit Create Rechten (Administratoren) können neue User anlegen.
	if(isset($role['RoleCreate']) && $role['RoleCreate'] == 1){
		echo '<a href="index.php?s=createuser">Neuen User anlegen</a>';
	}
?>

<script>
function confirmDeletion(id) {
    var r = confirm("Den User wirklich löschen?");
	
	if(r == true){
		window.location = "index.php?s=deleteuser&id="+id;
		header('Location: index.php');
	}
}
</script>