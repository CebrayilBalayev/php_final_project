<?php include "config.php";session_start();if (isset($_SESSION['id'])){ ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo$title;?></title>

	<style type="text/css">
		body{ margin: 0;background-color: #f6e9de;}
		a{ text-decoration: none; }
        li:last-child { border-right: none; }
        li a:hover, li input:hover{ background-color: #c2d2bd; }
        
        h1{
            height: 1.25em;
            margin: 0;
            font-size: 46px;
            background-color: #c2d2bd;
            text-align: center;
        }
        
        header{
            background-color: #c2d2bd;
            position: relative;
        }
        
        h4{
            position: absolute;
            top: 0;
            right: 0;
            margin: 4px;
            padding: 2px;
            border-left: thin solid ghostwhite;
            border-bottom: thin solid ghostwhite;
        }
        
        ul{
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #c65032;
        }   

        li {
            float: left;
            border-right:1px solid #bbb;
        }

        li a ,li input{
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
        }


        li input{
            background: none;
            border: none;
            font-size: 16px;
        }
	
    </style>

</head>
<body>
	<header>
        <h1><a href="interface.php" style="color: ghostwhite;">Crowdfunding</a></h1>
        <h4><?php echo $_SESSION['email']?></h4>
    </header>
    
    <nav>
        <ul>
            <li><a class="active" href="interface.php">Home</a></li>
            <li><a href="seefullstat.php">More statistics</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="addpr.php">Extra (Add new project)</a></li>
            <li><a href="deleteproject.php">Extra (Delete project)</a></li>
            <li><a href="myinvestments.php">Extra (Delete Investments)</a></li>
            <li style="float:right"> 
            	<a href="index.php">Log out</a>
            </li>
        </ul>
    </nav>

</body>
</html>

<?php } else header('Location: index.php');?>
