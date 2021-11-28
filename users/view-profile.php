<?php
include('../connection.php');
session_start();
$account_id = $_SESSION['account_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Document</title>
</head>
<body>
<?php    

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  function sendMail($email,$vkey,$account_id){
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
          $mail->Subject = 'Account Updated ';
          $mail->Body    = " You just updated your account, we humbly sent you a link to verify again your account. Thank you so much
           <a href='http://localhost/appointment_system/users/verify.php?email=$email&v_code=$vkey'>Verify</a>' 
           This is your still account id '$account_id' Have a great day." ;

          $mail->send();
          return true;
      } catch (Exception $e) {
          return false;
      }
      
       
   }

   $error = NULL;
?>
    

<?php

$query = "SELECT * FROM users WHERE account_id = '$account_id'";
$run = mysqli_query($conn,$query);
// need ko pa gumawa ng jquery dito para sa auto date of birth
if(mysqli_num_rows($run) > 0){
    foreach($run as $row) {
        ?>
            <div class="container">
            <a href="home.php">Back</a>
                <h2>Your Profile</h2>
                <dl class="row">
                    <dt class="col-sm-3">Account ID:</dt>
                    <dt class="col-sm-9"><?php echo $row ['account_id']?></dt>

                    <dt class="col-sm-3">Full Name: </dt>
                    <dd class="col-sm-9"><?php echo $row ['first_name'] . " " . $row['last_name']?> </dd>

                    <dt class="col-sm-3">Email: </dt>
                    <dd class="col-sm-9"><?php echo $row ['email']?></dd>

                    <dt class="col-sm-3">Gender: </dt>
                    <dd class="col-sm-9"><?php echo $row ['gender']?></dd>

                    <dt class="col-sm-3">Date of Birth: </dt>
                    <dd class="col-sm-9"><?php echo $row ['date_of_birth']?></dd>

                    <dt class="col-sm-3">Mobile Number: </dt>
                    <dd class="col-sm-9"><?php echo $row ['mobile_number']?></dd>

                    <div class="col-sm-3">
                        <!-- Button trigger modal -->
                        <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Edit Profile
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <h5>Important Reminder:</h5>
                                <p>Once you saved your changes, you will be automatically logged out and our system will send you another verification link on your email upon to activate your account.</p>
                                <hr>
                            <form action="view-profile.php" method="POST" class="row g-3 needs-validation" novalidate>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row ['first_name']?>" name="first_name" required>
                                        <div class="invalid-feedback">
                                            Please Input First Name.
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="validationCustom02" value="<?php echo $row ['last_name']?>" name="last_name" required>
                                        <div class="invalid-feedback">
                                            Please Input Last Name.
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Email</label>
                                    <input type="email" value="<?php echo $row ['email']?>" class="form-control" id="validationCustom02" name="email" required>
                                    <div class="invalid-feedback">
                                            Please Input Email.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Last Name</label>
                                    <input type="date" class="form-control" value="<?php echo $row ['date_of_birth']?>" id="validationCustom02" name="date_of_birth" required>
                                        <div class="invalid-feedback">
                                          Please Input Date of Birth
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="<?php echo $row ['mobile_number']?>" id="validationCustom02" placeholder="+63" pattern="[+][6]{1}[3]{1}[0-9]{10}" name="mobile_number" required>
                                        <div class="invalid-feedback">
                                          Please Input Mobile Number
                                          Or use
                                          Correct Format
                                        </div>
                                </div>
                                
                                <div class="col-md-4 p-2">
                                    <label for="validationCustom01" class="form-label">Gender:</label>
                                        <div class="row g-2 border bg-white" style="border-radius: 5px">
                                            <div class="col-5">
                                                
                                            <div class="form-check">
                                                    <input type="radio" class="form-check-input" value="Male" id="validationFormCheck2" name="gender" required>
                                                    <label class="form-check-label" for="validationFormCheck2">Male</label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input type="radio" class="form-check-input" value="Female" id="validationFormCheck3" name="gender" required>
                                                    <label class="form-check-label" for="validationFormCheck3">Female</label>
                                                    <div class="invalid-feedback"> Gender Required</div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr"></div>
                                </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" name="update" value="Save Changes">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </dl>
            </div>
          
        <?php
    }
}

?>

<script src="js/bootstrap.js"></script>
</body>
</html>

<?php

if(isset($_POST['update']) && $_POST['g-recaptcha-response'] != "" ){

    $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
    $response_data = json_decode($verify_response);

    if($response_data->success){

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $mobile_number = $_POST['mobile_number'];
        $gender = $_POST['gender'];

        $email_status = "0";

        $v_code = 0;


        date_default_timezone_set("Asia/Manila");
        $time= date("h:i:s", time());
        //year month date
        $date = date('y-m-d');
        $remarks = "Profile Updated";

        $query = "UPDATE users SET email='$email', first_name='$first_name', last_name='$last_name' , gender='$gender', date_of_birth='$date_of_birth', mobile_number = '$mobile_number', v_code='$v_code', email_status='$email_status',
        date_time_updated='$date $time' , remarks='$remarks' WHERE account_id='$account_id'";
        $run_query = mysqli_query($conn,$query);

        if($run_query){
            echo "updated";
            $vkey = md5(rand('10000' , '9999'));
            sendMail($email,$vkey,$account_id);
            $query_update2 = "UPDATE users SET v_code='$vkey' WHERE account_id = '$account_id'";
            $run_query2 = mysqli_query($conn,$query_update2);

            if($run_query2){
               echo "<script>window.location.href= 'logout.php' </script>";
            }else{
                echo "error" . $conn->error;
            }
        }else{
            echo "error" . $conn->error;
        }

    }
  
}


?>