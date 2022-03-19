<?php
// Database settings
$db="biblio";
$dbhost="localhost";
$dbport=3306;
$dbuser="root";
$dbpasswd="";
try {

$conn = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd,);
$conn->exec("SET CHARACTER SET utf8");
}
catch(Exception $e){
	
	echo "connection à la base de donnée impossible : ", utf8_encode($e->getMessage());
	die();
	
}
?>