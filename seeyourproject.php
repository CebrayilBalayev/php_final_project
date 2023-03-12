<?php 
	include "config.php";
	session_start();
    if (isset($_SESSION['id'])){
    $title="Investors";
    include "header.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Project</title>
	<style type="text/css">
        tr {border-bottom: thin solid #dddddd;}
		
        table {
            position: relative;
            left: 38vw;
            border-collapse: collapse; 
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            font-weight: thin;
            min-width: 24vw;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        
        td, th {
            border: thin solid;
            padding: 12px 15px;
        }
        
        #top{
            background-color: #5f2c3e;
            color: #ffffff;
            text-align: left;
            font-family: 'Poppins', sans-serif;        }

        #pie{
            float: right;
            border: thin solid white;
            border-radius: 340px;
        }

	</style>
</head>
<body>
    <h1 style="margin-top:3vh ;position: relative;left: 10vw; width: 80vw;background-color: gainsboro;color: brown;"><?php echo $_SESSION['Projectname'];?></h1>
	
    <table><tr id="top">
        <th>Investor</th>
        <th>Amount invested</th>
        <th>Date of investment</th>
        </tr>
        
        <?php
        $idofowner=$_SESSION['id'];
        $idofaproject=$_SESSION['idProject']; 

        //get requestedfund for this project
        $getrequestedfund=$conn->prepare("SELECT requestedFund FROM projects WHERE projects.idUser=? AND projects.idProject=?");
        $getrequestedfund->execute([$idofowner, $idofaproject]);

        $var_getrequestedfund = $getrequestedfund->fetch(PDO::FETCH_ASSOC);
        $requested=$var_getrequestedfund['requestedFund'];
            
            //get data for the table of investors
            $query=$conn->prepare("SELECT CONCAT(users.firstname, ' ', users.lastname) AS FIRSTNAME,projects_investors.investmentFund,projects_investors.investmentDate
            FROM projects,projects_investors,users
            WHERE projects.idProject=? AND projects_investors.idProject=projects.idProject AND projects_investors.idUser=users.idUser");
            $query->execute([$idofaproject]);
        while($var = $query->fetch(PDO::FETCH_ASSOC)){
        $money+=$var['investmentFund'];
        echo 
        "<tr><th>".$var['FIRSTNAME'].'</th>
        <th>'.$var['investmentFund'].'</th>
        <th>'.$var['investmentDate'].'</th></tr>';
        }
    

        echo 
        "<tr><th style='background-color: red;'>Total/From</th>
        <th>".$money.'</th>
        <th>'.$requested.'</th></tr>';

    	
        ?>
    
    </table>
</body>
</html>

<?php } else header('Location: index.php');?>