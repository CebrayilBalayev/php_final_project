<?php 
    include "config.php";
    session_start();
    $projectname=$_SESSION['Projectname']; 

    if (isset($_SESSION['id'])){
        if(isset($_POST['Delete'])){
            $projectid=$_SESSION['idProject']; 
            //delete project from projects table and it's investments from project_investors where 
            $delete= $conn->prepare("DELETE from projects WHERE idProject=?");
            $deleteindex= $conn->prepare("DELETE from projects_investors WHERE idProject=?");
            $delete->execute([$projectid]);
            $deleteindex->execute([$projectid]);
            header('Location: interface.php');  
        }
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>delete</title>
  <style type="text/css">
    body{text-align: center;color: ghostwhite;margin: 0;}
        form{
            background-color: black;
            padding:14px 20px;
            width: 50vw;
            position: relative;
            left: 25vw;
            top: 25vh;
            border-radius: 10px;
            
        }
        
        a,input{
            background: darkgrey;
            border: none;
            text-decoration: none;
            font-size: 20px;
            color: papayawhip;
            padding: 14px 20px;
            cursor: pointer;
            width: 23vw;
            float: left;
            border-radius: 30px;

        }
        

        input[type=submit] {
            background-color: red;float: right;
        }



    </style>
</head>
<body>
  <form action="" method="post" id="delete">

        <h1>Are you sure you want permanently delete <?php echo$projectname?> project ?</h1>
        <h2>If you delete a project, it will be permanently lost.</h2>

        <a href="deleteproject.php">Cancel</a>
        <input id="inp"type="submit" name="Delete" value="Delete" />


  </form>
</body>
</html>

<?php  } else header('Location: index.php');?>