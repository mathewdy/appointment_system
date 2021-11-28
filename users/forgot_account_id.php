<?php    

include('../connection.php');
session_start();
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
          $mail->Subject = 'Forgot account Id';
          $mail->Body    = "We heard that you lost your account id. Sorry about that. But don't worry. This is your new account id $code. 
          If it is not you, please disregard this message. Thank you";
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container-md">
        <h2>Please Enter Your Email Address</h2>
        <form action="forgot_account_id.php" method="POST" class="needs-validation" novalidate>
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Email</label>
                <input type="email" class="form-control" id="validationCustom01" name="email" required>
                    <div class="invalid-feedback">
                        Enter Your Email Address
                    </div>
            </div>
            <br>
                <div>
                    <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr"></div>
                </div>
            <br>
            <div class="col-md-4">
                <input class="btn btn-primary" name="forgot" type="submit" >
            </div>   
            
        </form>
        <br>
        <a href="login.php">Cancel</a>
    </div>

</body>
</html>

<?php


if(isset($_POST['forgot']) && $_POST['g-recaptcha-response'] != ""){

    $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
    $response_data = json_decode($verify_response);

    if($response_data->success){

        $email = $_POST['email'] ;
        $code =  "2021" . rand('00000', '99999');

        $query = "SELECT * FROM users WHERE email='$email'";
        $run_Query = mysqli_query($conn,$query) ;

        if($run_Query){
            if(mysqli_num_rows($run_Query) > 0){
                sendMail($email,$code);
                $_SESSION['email'] = $email;
                $_SESSION['code'] = $code;
                header("Location: validate.php");
            }
        }else{
            echo "error" . $conn->error;
        }
    }
}


?>

<script>

(function () {
'use strict'
var forms = document.querySelectorAll('.needs-validation')

Array.prototype.slice.call(forms)
.forEach(function (form) {
form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
    event.preventDefault()
    event.stopPropagation()
    }
    form.classList.add('was-validated')
}, false)
})
})()
</script>