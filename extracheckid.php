<?php
	include "config.php";
    session_start();

    	$_SESSION['idProject']=$_GET['id'];
    	$_SESSION['Projectname']=$_GET['name'];
    	header('Location: depermanently.php');



?>