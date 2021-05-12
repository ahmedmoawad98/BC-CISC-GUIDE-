<!DOCTYPE html>
<html>
<head>
 <title>Forgot Password</title>
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
     <form  action= "Forgot_Password.php" method ="post">
       <div style="font-size:20px; margin: 10px; color:black;" >Forgot Password ?</div>
       <p>
         Please Enter your Email Address that you used when Signing up.
       </p>

       <label for="Email"><b>Email</b></label>
       <input id="text" type="email" name="Email" /> <br />


       <input id="button" type="submit"  value="Send Email" /><br />
        <!-- <a href="login.php">Click to go back to Login</a> <br /> -->
 </center>



   </form>

 </div>
</body>
</html>
