<?php
  use PHPMailer\PHPMailer\PHPMailer;
session_start();

  include("connection.php");
  //include("functions.php");
if(isset($_POST['password-reset-token']) && $_POST['email'])
{
   //  include "db.php";

    $emailId = $_POST['email'];

    $result = mysqli_query($con,"SELECT * FROM users WHERE email='" . $emailId . "'");

    $row= mysqli_fetch_array($result);

  if($row)
  {

     $token = md5($emailId).rand(10,9999);

     $expFormat = mktime(
     date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
     );

    $expDate = date("Y-m-d H:i:s",$expFormat);



    $tempSQL = "UPDATE users set  password='" . $row['password'] . "', reset_link_token='" . $token . "' ,exp_date='" .   $expDate . "' WHERE email='" .$emailId. "'";

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
      }
    try{
      $update = mysqli_query($con,  $tempSQL);
      if ($update)
          console_log( "Update sucessful!");
      else
        console_log("Update Error!");
    }
    catch(Exception $e){
      console.log( "Message: Error" );
    }

    //$update = mysqli_query($con,"UPDATE users set  password=' $row['password'] "', reset_link_token='" .$token. "' ,exp_date='" .$expDate. "' WHERE email='" .$emailId. "'");

    $link = '<a href=localhost/BC_CIS_Guide/Reset_Password/reset-password.php?key=' . $emailId . '&token=' . $token . '> Click To Reset password</a>';

    console_log($link);

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();



    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;
    // GMAIL username
    $mail->Username = "BCCISGuide@gmail.com";
    // GMAIL password
    $mail->Password = "CISC4900";
    $mail->SMTPSecure = "tls";
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "25";
    $mail->From='BCCISGuide@gmail.com';
    $mail->FromName='BC CIS Guide';
    $mail->AddAddress('email@email.com');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }else{
    echo "Invalid Email Address. Go back";
  }
}
 ?>
