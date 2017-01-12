<?php 
	/*	Hier wird dem angegeben, dass diese PHP Datei eine CSV Datei sei, ruft der Nutzer also diese Seite auf, wird ihm ein
		Download mit der Kunden.csv präsentiert.
		CSVs haben Probleme, wenn in einen der Werte ein Komma ist (Beispielsweise bei einer Adresse). Hier sollte man
		eventuell noch einen Fix einbauen.
		Die hier von mir verwendete Methode ist auf Dauer nicht sehr perfomant. Eventuell wäre es klüger, eine CSV
		Datei auf dem Server zu lagern und diese bei einer Usererstellung zu aktualisieren.
	*/
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="Kunden.csv"');

	require_once('database.php'); //Verbindung zur Datenbank wird hergestellt
	
	//CSV wird generiert
	echo "Kundennummer, Nutzername, Vorname, Nachname, E-Mail, Telefon \r\n";
	$statement = $pdo->prepare("SELECT * FROM user ORDER BY UserID");
	$result = $statement->execute();
	for($i = 1; $row = $statement->fetch(); $i++) {
		echo $row['UserID'].", ";
		echo $row['UserName'].", ";
		echo $row['UserFirstName'].", ";
		echo $row['UserLastName'].", ";
		echo $row['UserMail'].',';
		echo $row['UserTelephone'];
		echo "\r\n";
	}
 ?>