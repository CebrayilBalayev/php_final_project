<?php 
    include "config.php";
    session_start();
    if (isset($_SESSION['id'])){
    $title="Investments";
    include "header.php";

    if (isset($_POST["getback"]))
   {
   	//delete your investment
       $delete= $conn->prepare("DELETE from projects_investors WHERE idProject=? and idUser=?");
       $delete->execute([$_POST["getback"],$_SESSION['id']]);

   }

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
        button:hover{ background-color:darkred;}

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
            
        #top{
            background-color: #5f2c3e;
            color: #ffffff;
            text-align: left;
            font-family: 'Poppins', sans-serif;        }
        
        button{
            background: #c2d2bd;
            border-radius: 10px;
            color: black;
        }

    </style>
</head>
<body>
    <table><tr id="top">
        <th>Name</th>
        <th>Date of investment</th>
        <th>Amount of investment</th>
        <th>Get investment back</th>
        </tr>
        
        <?php  $userid=$_SESSION['id'];

        //show table
        $query=$conn->prepare("SELECT * from projects_investors,projects WHERE projects_investors.idUser=? and projects.idProject=projects_investors.idProject");
        $query->execute([$userid]);
        while($var = $query->fetch(PDO::FETCH_ASSOC)){
            
            echo 
        "<tr><th>".$var['projectName'].'</th>
        <th>'.$var['investmentDate'].'</th>
        <th>'.$var['investmentFund'].'</th><th>';?>
        <form action="" method="post"><button name="getback" value="<?php echo$var['idProject']?>">Get back</button></form>
       <?php 
    }?>
    </table>
</body>
</html>

<?php } else header('Location: index.php');?>