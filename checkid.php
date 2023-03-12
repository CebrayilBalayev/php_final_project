<?php
	include "config.php";
    session_start();
	$idproj=$_GET['id'];
	$getownerid=$conn->prepare("SELECT idUser from projects WHERE idProject=?");
    $getownerid->execute([$idproj]);
    $var_getownerid = $getownerid->fetch(PDO::FETCH_ASSOC);

    $projectowner=$var_getownerid['idUser'];

    if($projectowner==$_SESSION['id']){
    	$_SESSION['idProject']=$idproj;
    	$_SESSION['Projectname']=$_GET['name'];
    	header('Location: seeyourproject.php');

    }
	else{
	$_SESSION['idProject']=$idproj;
	header('Location: invest.php');

}

?>