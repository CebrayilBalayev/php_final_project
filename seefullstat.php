<?php 
	include "config.php";
	session_start();
    if (isset($_SESSION['id'])){
    $title="Graphs";
    include "header.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Statistics</title>
</head>

<body>
<?php
    //get requested fund and all fundings to get the ratio (in %)
    $query=$conn->prepare("SELECT projects.projectName,projects.requestedFund,SUM(projects_investors.investmentFund) AS money
                        FROM projects,projects_investors
                        WHERE projects.idProject=projects_investors.idProject
                        GROUP BY projects.idProject");
    $query->execute();
    while($var = $query->fetch(PDO::FETCH_ASSOC)){?>
        <img src="piea.php?pr=<?php echo $var['money']*100/$var['requestedFund'] ?>&title=<?php echo $var['projectName']?>" id='pie' style="float: left;">
    <?php   }   ?>

</body>
</html>

<?php } else header('Location: index.php');?>