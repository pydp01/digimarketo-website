<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, in-itial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="img\logo.png">
        <title>
          Sign in
        </title>
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
                 Sign In
        </h1>
    </div>
    <div>
      <form action="signin.php" method="POST">
            E-mail<br>
            <input type="e-mail" name="email" required>
            <br>
            User ID <br>
            <input type="text" name="userid" required>
            <br>
            Password
            <br>
            <input type="password" name="pass" required>
            <br>
            Confirm Password
            <br>
            <input type="password" name="cpass" required>
            <br>
            <button name="sign">Signin</button>
            <button name="cancel"> <a href="index.php"> Cancel</a></button>
          </form>
        <br>
</div>
</div>
</body>
</html>





<?php

include "db.php";

if(isset($_POST['sign']))
{
    $MAIL=$_POST['email'];
    $USER=$_POST['userid'];
    $PASS=$_POST['pass'];
    $CONFIRM=$_POST['cpass'];
    $errors=0;
    $password = md5($PASS);//encrypt the password before saving in the database
    $conpass= md5($CONFIRM);  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
     if ($PASS != $CONFIRM) 
     {
	    echo'<script>alert("The two passwords do not match")</script>';
      ++$errors;
     }


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "select * from data where UserID='$USER' OR Email='$MAIL' LIMIT 1";
  $res = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($res);
  switch ($user) {
  
    case '$user["UserID"]==$USER':
      echo'<script>alert("User already exists")</script>';
      ++$errors;
      break;
    
    case '$user["Email"]==$MAIL':
      echo'<script>alert("Email already exists")</script>';
      ++$errors;
      break;

  }
if ($errors == 0) 
  {
    
    $insertquery="insert into data(Email,UserID,Password,ConfirmPassword) values('$MAIL','$USER','$password','$conpass')";
    $result=mysqli_query($conn,$insertquery);

    if($result)
    {
        echo'<script>alert("Data Inserted")</script>';
        echo "<script>window.location.assign('login.php');</script>"; 
    }
    else
    {
        echo'<script>alert("Data is not inserted becuase: '.mysqli_error($conn).'")</script>';
    }
}
}
?>