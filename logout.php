<?php
	session_destroy();
 
	echo '<p class="warning">Logout erfolgreich</p>';
	
	header('Location: index.php');
	exit;
?>