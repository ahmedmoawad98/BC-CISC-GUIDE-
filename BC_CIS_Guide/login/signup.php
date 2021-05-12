<?php
session_start();

  include("connection.php");
  include("functions.php");

$Error = "";
  if($_SERVER['REQUEST_METHOD'] =="POST")
  {
    //sometihng was posted
    $user_name = trim($_POST['user_name']);
    if (!preg_match("/^[a-zA-Z0-9]+$/",$user_name))
    {
      $Error = "Please enter a valid username";
    }
    $user_name = esc($user_name);
    $password =  esc($_POST['password']);
    $Email = $_POST['Email'];
    if (!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/",$Email))
    {
      $Error = "Please enter a valid Email";
    }

    if (!empty($Email) &&!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
      if($_POST['password'] != $_POST['passwordrepeat']){
        echo "Your passwords did not match. Please try again";
        //exit();
        }
      else {
  // code...
        // The hash of the password that
        // can be stored in the database
        $hash = password_hash($password,
        PASSWORD_DEFAULT);
if ($Error ==""){
        //save to database
        $user_id = random_num(20);
        $query = "insert into users (user_id,user_name,password,Email) values ('$user_id','$user_name','$hash','$Email')";

        mysqli_query($con,$query);

        header("Location: index.php");
        die;
      }
      }
    }else
    {
      echo "Please enter some valid information!";
    }

  }

 ?>

 <!DOCTYPE html>
 <html>
<head>
  <title>Sign up</title>
</head>
<body style="background-image: url('/BC_CIS_Guide/images/brooklyncollege.png'); background-repeat: no-repeat;  background-attachment: fixed;
  background-size: cover;">
  <style type="text/css">
  #text{

  		height: 25px;
  		border-radius: 5px;
  		padding: 4px;
  		border: solid thin #aaa;
  		width: 100%;
  	}

  	#button{

  		padding: 10px;
  		width: 100px;
  		color: white;
  		background-color: lightblue;
  		border: none;
  	}

  	#box{

      background-color: white;
  		margin: auto;
  		width: 300px;
  		padding: 20px;
      margin: 10px;
      height: 425px;
      width: 300px;
      border-radius: 25px;
      border-radius: 2px solid #f3efef;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: rgb(7, 7, 7);
      background-image: linear-gradient(to right, #faeaea 0%, #bbe2e2 100%);
      transition: 0.3s ease-in;

  	}
  </style>
  <center>
    <div id="box">
      <form method ="post">
        <div><?php
          if (isset($Error)&& $Error != "")
          {
            echo $Error;
          }
         ?></div>
        <div style="font-size:20px; margin: 10px; color:black;" >Sign up</div>

        <label for="Email "><b>Email (must enter vaild email)</b></label>
        <input id="text" type="text" name="Email" /> <br />
        <label for="user_name "><b>Username (only letters and numbers)</b></label>
        <input id="text" type="text" name="user_name" /> <br />
        <label for="psw"><b>Password</b></label>
        <input id="text" type="password" name="password" /><br />
         <label for="psw-repeat"><b>Repeat Password</b></label>
        <input id="text" type="password" name="passwordrepeat" /><br />

        <input id="button" type="submit" value="Sign up" /><br />

        <a href="index.php">Click to Login</a> <br />

  </center>


    </form>

  </div>
</body>
</html>
