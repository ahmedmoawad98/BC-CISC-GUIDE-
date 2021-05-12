<?php
session_start();

  include("connection.php");
  include("functions.php");


  if($_SERVER['REQUEST_METHOD'] =="POST")
  {
    //sometihng was posted
    $user_name = $_POST['user_name'];
    $password =  $_POST['password'];


    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        //read from  database
        $query = "select * from users where user_name = '$user_name' limit 1 ";
        $result = mysqli_query($con,$query);

        if($result)
        {
          if($result && mysqli_num_rows($result) > 0)
          {
            $user_data = mysqli_fetch_assoc($result);
            $hash =$user_data['password'];
            if(password_verify($password,$hash))
            {
              $_SESSION['user_id'] = $user_data['user_id'];
              header("Location: /BC_CIS_Guide/Home_Page/home.html");
              die;
            }
          }
      }
        }
          echo "Wrong username or password";
    }else
    {
      //echo "Please enter some valid information!";
    }



 ?>

 <!DOCTYPE html>
 <html>
<head>
  <title>Login</title>
  <center>
    <h1>
      BC CIS Guide
    </h1>
  </center>
</head>
<body style="background-image: url('/BC_CIS_Guide/images/brooklyncollege.png'); background-repeat: no-repeat;  background-attachment: fixed;
  background-size: cover;" >


  <style type="text/css">
  h1 {
    font-family: Century Gothic;
    color: black;
    font-size: 300%;
}

  #text{

    font-family: Century Gothic;
  		height: 25px;
  		border-radius: 5px;
  		padding: 4px;
  		border: solid thin #aaa;
  		width: 100%;
  	}

  	#button{

      font-family: Century Gothic;
  		padding: 10px;
  		width: 100px;
  		color: white;
  		background-color: blue;
  		border: none;
  	}

  	#box{

      font-family: Century Gothic;
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
    <div id="box"  >
      <form method ="post">
        <div style="font-size:20px; margin: 10px; color:black;" >Login</div>
        <label for="user_name "><b>Username</b></label>
        <input id="text" type="text" name="user_name" /> <br />
        <label for="psw"><b>Password</b></label>
        <input id="text" type="password" name="password" /><br />
        <input id="button" type="submit" value="Login" /><br />
        <a href="signup.php" >Click to Sign up</a> <br />
        <a href="/BC_CIS_Guide/Reset_Password/reset-password.html">Forgot Password</a> <br />

  </center>

    </form>

  </div>
</body>
</html>
