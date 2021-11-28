<?php

//doctors 
   ///NAAGA NA ITO MAY MALI LANG SA PATIENTS> I DONT KNOW WHY SHAHSHA
   include('../connection.php');
   //gumamit ako ng php mailer
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  function sendMail($email,$code){
      require ("PHPMailer.php");
      require("SMTP.php");
      require("Exception.php");

      $mail = new PHPMailer(true);

      try {
          //Server settings
         
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'mathewmelendez123123123@gmail.com';                     //SMTP username
          $mail->Password   = '62409176059359';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      
          //Recipients
          $mail->setFrom('mathewmelendez123123@gmail.com', 'Novaliches General Hospital');
          $mail->addAddress($email);     //Add a recipient
      
          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Forgot Account Id ';
          $mail->Body    = "We heard that you lost your account id. Sorry about that. But don't worry. This is your new account id $code. 
          If it is not you, please disregard this message. Thank you" ;

          $mail->send();
          return true;
      } catch (Exception $e) {
          return false;
      }
      
       
   }

   $error = NULL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/forgot-account-doctors.css">
</head>
<body>

    <div class="container">
    <form action="forgot_account_id.php" method="POST">
    <h3>Please Enter Your Email Address</h3><br>
    <input type="email" name="email">
    <input type="submit" name="forgot">
    </form>
    <a class="btn btn-primary" href="login.php" role="button">Cancel</a>
    </div>

</body>
</html>

<?php
session_start();

if(isset($_POST['forgot'])){

    $email = $_POST['email'];

    $code = "2021" . rand('50000', '4000');
    $query = "SELECT * FROM users WHERE email = '$email'";
    $run = mysqli_query($conn,$query) ;
    if(mysqli_num_rows($run) > 0){
        sendMail($email,$code);
        $_SESSION['code'] = $code;
        $_SESSION['email'] = $email;
        echo header("Location: validate.php");
    }else{
    echo "no account";
}
}
?>