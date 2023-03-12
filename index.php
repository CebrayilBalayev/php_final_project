<?php
    session_start();
    session_destroy();
	include "config.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login page</title>

	<style type="text/css">
        input[type=submit]:hover {opacity: 0.8;background-color:#d1adcc ;}
		
        body{
            text-align: center;
            background-color: #f6e9d7;
        }
    
        h1{ 
            color: papayawhip;
            text-decoration: underline;
            margin-left: 25vw;
            margin-right: 25vw;
            background-color: #5f2c3e;
        }
        
        form{
            background-image: url('img/login.jpg');
            background-size: 70vw;
            border: 3px solid #c65032;
            width: 70vw;
            position: relative;
            left: 14.3vw;
            top: 13vw;
        }

        input[type=text], input[type=password] {
            width: 80%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #5f2c3e;
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

<?php
    if(isset($_POST['but_submit'])){
        $email = $_POST['email'];
        $password = $_POST['txt_pwd'];

        //check if exists
        $check = $conn->prepare("select count(*) as cntUser from users where email=? and password=?");
        $check->execute([$email, $password]);
        $user = $check->fetch();
        $count = $user['cntUser'];
        
        if($count > 0){
            $_SESSION['email'] = $email;

            //get id of user
            $getid= $conn->prepare("select idUser from users where email=?");
            $getid->execute([$email]);
            $res = $getid->fetch();
            $_SESSION['id'] = $res["idUser"];
                
            header('Location: interface.php');  }
        else{
            echo "<h1 style='color: lime;background-color: red;'>Invalid username and password</h1>";   }
        

        }
?>

<body>
    <form method="post" action="">
            <h1>Login</h1>
            <input type="text" class="textbox" id="email" name="email" placeholder="Email" required />
            <input type="password" class="textbox" id="email" name="txt_pwd" placeholder="Password" required />
            <input type="submit" value="Submit" name="but_submit" id="but_submit" />
    </form>
</body>
</html>

