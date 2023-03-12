<?php 
	include "config.php";
	session_start();
    if (isset($_SESSION['id'])){
    $title="Add project";
    include "header.php";

    $userid=$_SESSION['id'];
    $currentdate=date("Y-m-d");
    $query=$conn->prepare("SELECT CONCAT(users.firstname, ' ', users.lastname) AS FULLNAME from users WHERE users.idUser=?");
        $query->execute([$userid]);
        $var = $query->fetch(PDO::FETCH_ASSOC);
    $fullname=$var['FULLNAME'];
    if(isset($_POST['CREATE'])){
        $requested = $_POST['requested'];
        $startdate = $_POST['start'];
        $enddate = $_POST['end'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        
        if($startdate<$currentdate)echo"<h1 style='color: lime;background-color: red;'>You are not allowed to choose past for starting date</h1>";
        else if($enddate<$startdate)echo"<h1 style='color: lime;background-color: red;'>The end date of a project can not be before the starting date</h1>";
        else if($requested<=0)echo"<h1 style='color: lime;background-color: red;'>Requested fund should be positive</h1>";
        else{
            $insert= $conn->prepare("INSERT INTO projects (projectName, projectDescription,projectStartDate,projectEndDate,requestedFund,idUser) VALUES(?,?,?,?,?,?)");
            $insert->execute([$name,$description,$startdate,$enddate,$requested,$userid]);
            header('Location: interface.php');  }
        }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEW Project</title>
    <style type="text/css">
        
        input[type=submit]:hover {opacity: 0.8;color: #c65032;background-color:#f6e9de ;}
        
        body{
        text-align: center;
        margin: 0px;
        background-color: #d1adcc;
        }
    
        #create{
            background-color: #5f2c3e;
            width: 40vw;
            height: 36vw;
            position: relative;
            left: 30vw;
            top: 1vw;
        }
        
        input{
            position: relative;
        }
        
        input[type=number], input[type=date], #name{
            width: 80%;
            padding: 12px 20px;
            margin: 28px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 50px;
        }

        #description{
            width: 80%;
            padding: 12px 20px;
            margin: 35px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
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

        h2{margin: 0;background-color: ghostwhite;color: #5f2c3e;}
    </style>
</head>
<body>
    <form action="" method="post" id="create">
        <h1 style="color:#c65032;background-color:#f6e9de; "><?php echo $fullname;?>'s new project</h1>
        <input type="text" name="name" id="name" placeholder="NAME of the project"required><br>
        <input type="text" name="description" id="description" placeholder="Description"required><br>
        <h2>Starting date</h2><br>
        <input type="date" name="start" required><br>
        <h2>End date</h2><br>
        <input type="date" name="end" required><br>
        <input type="number" name="requested" placeholder="Requested Fund"required><br>
        <input id="inp" class="" type="submit" name="CREATE" value="CREATE" />
    
    </form>
</body>
</html>

<?php } else header('Location: index.php');?>