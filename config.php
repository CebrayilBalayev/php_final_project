<?php 
	session_start();
	$host="localhost";
	$user="root";
	$parol="";
	$bd="balayev_hwproj";
	try {
  		$conn = new PDO("mysql:host=$host;dbname=$bd", $user, $parol);
  		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
  	catch(PDOException $e){
  		echo "Connection failed: " . $e->getMessage();
			}
?>
