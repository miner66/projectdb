<?php




function getQuery($query){
	//Inlog gegevens
	$hostname = 'databases.aii.avans.nl:3306';
	$username = 'blmkroez';
	$password = "Ab12345";
	$database = 'blmkroez_db';
	
	//Connectie
	
	$db = new mysqli($hostname, $username, $password, $database);
	if ($db->connect_errno){
	 die('Unable to connect: ' . $db->connect_error);
	}
	
	//Querry
	 $result = $db->query($query);
	 if (!$result){
	  die('There was an error: ' . $db->error);
	 }
	 
	//Toon resultaten
	 
	
	
	//Sluit connectie
	 
	$db->close();
	return $result;
}


 ?>