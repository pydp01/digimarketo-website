<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <style>
    *{
        padding: 0;
        margin: 0;
    }
    #bg{
        background-color:  rgb(122, 122, 216);

    }
    .form{
        text-align: center;
        padding-top: 200px;
    }
    form{
        background-color: white;
        font-size: 20px;
        padding: 10px 0 20px 0;
        margin: 10px 200px 0 200px;
    }
    form input{
        font-size: 20px;
    }
    button a{
        font-size: 15px;
        color: white;
        margin: 20px 0 0 0;
        padding: 5px;
        background-color: black;
        text-decoration: none;
    }
    button a:hover{
        color: gray;
        font-size: 13px;
    }
    button{
        font-size: 15px;
        color: white;
        margin: 20px 0 0 0;
        padding: 5px;
        background-color: black;
    }
    button:hover{
        color: gray;
        font-size: 13px;
    }
</style>
    </head>
<body id="bg">
<div class="form">
    <div>
        <h1>
                 Login Here 
        </h1>
    </div>
    <div>
    <form action="login.php" method="POST">
            Email Id <br>
            <input type="text" id="i1" name="user" required>
            <br>
            Password 
            <br><input type="password" id="i2" name="pass" required>
            <br>
            <button class="bts" name="login">Login</button>
            <button class="bts" name="cancel"><a href="index.php">Cancel</a></button>
    </form>
    </div>
</div>
</html>



<?php     
	session_start(); 
    include('db.php'); 
	if(isset($_POST['login']))
{ 
    $email= $_POST['user'];  
    $password= $_POST['pass'];  
    $password=md5($password);
        //to prevent from mysqli injection  
        $email = stripcslashes($email);  
        $password = stripcslashes($password);  
        $email = mysqli_real_escape_string($conn, $email);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "SELECT * FROM data WHERE Email = '$email' AND Password = '$password'"; 
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
			$_SESSION['email9']=$email;
            $_SESSION['passwordf']=$password;
            echo "<script>alert('Login Successfull');</script>";  
			echo "<script>window.location.assign('admin.php');</script>"; 
            }  
            else{  
                echo "<script>alert('Only Admin Can Access this');</script>";   
            }
    }
    
?>  
