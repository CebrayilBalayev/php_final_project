<?php 
	include "config.php";
	session_start();
    if (isset($_SESSION['id'])){
    $title="Invest";
    include "header.php";

    $userid=$_SESSION['id'];
    $projectid=$_SESSION['idProject']; 
    
        //get max fund possible
        $query=$conn->prepare("SELECT projectEndDate,projectName,requestedFund,(projects.requestedFund-SUM(projects_investors.investmentFund)) as diff
                                FROM projects,projects_investors
                                WHERE projects.idProject=? AND projects.idProject=projects_investors.idProject");
        $query->execute([$projectid]);
        $var = $query->fetch(PDO::FETCH_ASSOC);
        $diff=$var['diff'];

        //for extra add project, if there is no foundation code below will correct it
        if($diff==NULL)$diff=$var['requestedFund'];
        $name=$var['projectName'];
        $enddate=$var['projectEndDate'];

    if(isset($_POST['INVEST'])){
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        
        //check for false insertings
        if($amount>$diff)echo"<h1 style='color: lime;background-color: red;'>The maximum amount to invest is ".$diff.'</h1>';
        else if($amount<1)echo"<h1 style='color: lime;background-color: red;'>The minimum amount to invest is 1</h1>";
        else if($date>$enddate)echo"<h1 style='color: lime;background-color: red;'>It is too late funding ended in ".$enddate.'</h1>';
        else{
            //insert new row
            $insert= $conn->prepare("INSERT INTO projects_investors (idUser, idProject,investmentFund,investmentDate) VALUES(?,?,?,?)");
            $insert->execute([$userid,$projectid,$amount,$date]);
            header('Location: interface.php');  }
        }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invest</title>
    <style type="text/css">
        
        input[type=submit]:hover {opacity: 0.8;color: #c65032;background-color:#f6e9de ;}
        
        body{
        text-align: center;
        margin: 0px;
        background-color: #d1adcc;
        }
    
        #invest{
            background-color: #5f2c3e;
            width: 40vw;
            height: 20vw;
            position: relative;
            left: 30vw;
            top: 10vw;
        }
        
        input{
            position: relative;
            top: 6vh;
        }
        
        input[type=number], input[type=date] {
            width: 80%;
            padding: 12px 20px;
            margin: 28px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 50px;
        }

        input[type=submit] {
            background-color: #c65032;
            font-size: 20px;
            color: papayawhip;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

    </style>
</head>
<body>
    <form action="" method="post" id="invest">
        <h1 style="color:#c65032;background-color:#f6e9de; ">Invest to <?php echo $name;?> project</h1>
        
        <input type="number" name="amount" placeholder="amount"required><br>
        <input type="date" name="date" required><br>
        <input id="inp" class="" type="submit" name="INVEST" value="INVEST" />
    
    </form>
</body>
</html>

<?php  } else header('Location: index.php');?>