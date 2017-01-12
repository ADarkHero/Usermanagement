<?php		
	//Zugangsdaten zur Datenbank
	$db_host = "localhost";
	$db_name = "project";
	$db_user = "root";
	$db_pass = "";
	
	$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
		
	//Hiermit wird ausgelesen, welche Rechte die eigene Rolle hat
	function getRole($pdo){	
		$statement = $pdo->prepare("SELECT * FROM role WHERE RoleID =:roleID");
		$statement->bindValue(':roleID', $_SESSION["role"]);
		$statement->execute();
		$role = $statement->fetchAll();
		return $role[0];
	}
	
	//Gibt Name und ID aller Rollen zurück
	function getAllRoles($pdo){	
		$statement = $pdo->prepare("SELECT RoleID, RoleName FROM role ORDER BY RoleName DESC");
		$statement->execute();
		$role = $statement->fetchAll();
		return $role;
	}
?>