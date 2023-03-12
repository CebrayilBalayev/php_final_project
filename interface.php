<?php 
    include "config.php";
    session_start();
    if (isset($_SESSION['id'])){
    $title="Home Page";
    include "header.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>Interface</title>
    <style type="text/css">
        tr {border-bottom: thin solid #dddddd;}
        .br{ background: #F5F5DC; }
        .br:hover{ background-color: #5f2c3e; }
        a:hover{ color:#F5F5DC;}

        table {
            border-collapse: collapse; 
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            font-weight: thin;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        
        td, th {
            border: thin solid;
            padding: 12px 15px;
        }
        
        
        tr:hover {
        font-weight: bold;
        color: #5f2c3e;
        background-color: #d1adcc;
        }
            
        #top{
            background-color: #5f2c3e;
            color: #ffffff;
            text-align: left;
            font-family: 'Poppins', sans-serif;        }
        
        a{
            background: none;
            border: none;
            color: black;
        }

    </style>
</head>
<body>
    <table><tr id="top">
        <th>Project</th>
        <th>Description</th>
        <th>Owner</th>
        <th>END date</th>
        <th>Requested fund</th>
        <th>INVEST</th>
        </tr>
        
        <?php  $userid=$_SESSION['id'];

        //show table
        $query=$conn->prepare("SELECT *,CONCAT(users.firstname, ' ', users.lastname) AS FIRSTNAME from projects,users WHERE projects.idUser=users.idUser");
        $query->execute();
        while($var = $query->fetch(PDO::FETCH_ASSOC)){
            //see if user invested to this project
            $ifinvested=$conn->prepare("SELECT investmentFund from projects_investors WHERE projects_investors.idUser=? AND idProject=?");
            $ifinvested->execute([$userid,$var['idProject']]);
            $isinv = $ifinvested->fetch(PDO::FETCH_ASSOC);

            if($var['idUser']==$_SESSION['id']){
            echo 
        "<tr style='background-color: #c2d2bd'><th>".$var['projectName'].'</th>
        <th>'.$var['projectDescription'].'</th>
        <th>'.$var['FIRSTNAME'].'</th>
        <th>'.$var['projectEndDate'].'</th>
        <th>'.$var['requestedFund'].'</th>';
            ?>
            <th class='br'>
                <a href="checkid.php?id=<?php echo $var['idProject']  ?>&name=<?php echo $var['projectName']  ?>">DETAIL</a>
            </th></tr>
            <?php
        }
            
        else{
            echo 
        "<tr><th>".$var['projectName'].'</th>
        <th>'.$var['projectDescription'].'</th>
        <th>'.$var['FIRSTNAME'].'</th>
        <th>'.$var['projectEndDate'].'</th>
        <th>'.$var['requestedFund'].'</th>';

        if($isinv['investmentFund']>0)echo "<th style='color: #5f2c3e;'>invested ".$isinv['investmentFund'].'</th></tr>';
        else{
            ?>
            <th class='br'>
                <a href="checkid.php?id=<?php echo $var['idProject'];?>">INVEST</a>
            </th></tr>
            <?php
        }}
        
    }?>
    </table>
</body>
</html>

<?php } else header('Location: index.php');?>