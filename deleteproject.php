<?php 
    include "config.php";
    session_start();
    if (isset($_SESSION['id'])){
    $title="Delete Project";
    include "header.php";

    $userid=$_SESSION['id'];

    //get all projects of the user
    $query=$conn->prepare("SELECT projects.idProject,projectName,requestedFund
                            FROM projects
                            WHERE projects.idUser=?");
        $query->execute([$userid]);
        
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>delete</title>
  <style type="text/css">
        tr {border-bottom: thin solid #dddddd;}
        .br{ background: #F5F5DC; }
        .br:hover{ background-color: red; }
        a:hover{ color:#F5F5DC;}

        table {
            background-color: ghostwhite;
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
        
        a{
            background: none;
            border: none;
            color: black;
        }

    </style>
</head>
<body>
  <h1 style="color: purple;background: peachpuff;">Projects</h1>
  <?php while($var = $query->fetch(PDO::FETCH_ASSOC)){
    echo
    "<table><tr><th>".$var['projectName'].'</th></tr>';

    ?>
           <tr><th class='br'>
                <a href="extracheckid.php?id=<?php echo $var['idProject']  ?>&name=<?php echo $var['projectName']  ?>">DELETE</a>
            </th></tr>
         
    </table>


</body>
</html>

<?php  }} else header('Location: index.php');?>
