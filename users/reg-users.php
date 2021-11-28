<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Online Appointment System</title>
</head>
<body>

       
      

 
<!--yan nagana na yan hahaha-->
   
   <?php    
//secretary to 
   ///NAAGA NA ITO MAY MALI LANG SA PATIENTS> I DONT KNOW WHY SHAHSHA
   include('../connection.php');
   //gumamit ako ng php mailer
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
          $mail->Subject = 'Email Verification from Novaliches General Hospital ';
          $mail->Body    = "Thanks for registration! Hello $email welcome to <b> NGH </b> 
          Click the link to verify the email address. 
           <a href='http://localhost/appointment_system/users/verify.php?email=$email&v_code=$vkey'>Verify</a>' 
           This is your account id '$account_id' Have a great day." ;

          $mail->send();
          return true;
      } catch (Exception $e) {
          return false;
      }
      
       
   }

   $error = NULL;
    ?>
<div class="container-md">
    <form action="reg-users.php" method="POST" class="row g-3 needs-validation" novalidate>

    <div class="img-fluid">
        <img src="../css/logo.png" alt="Logo" >
    </div>

        <ul>
            <li>
                <a href="homepage.php">Home</a>
                <a href="#">About</a>
                <a href="#">Doctors</a>
                <a href="">Secretary</a>
            </li>
        </ul>

        <!-----sign up nya-->
        <!--yung nasa NAME na input yan yung mga inputed data na ipapasok sa database-->
        <!--gumamit ng POST method para ma secure yung pag input sa DB--->
        <h3>Sign up</h3>

        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Email</label>
            <input type="email" class="form-control" id="validationCustom01" placeholder="sample@gmail.com" name="email" required>
            <div class="invalid-feedback">
                Input Required
            </div>
        </div>
        
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">First Name</label>
            <input type="text" class="form-control" id="validationCustom01" name="first_name" required>
            <div class="invalid-feedback">
                Input Required
            </div>
        </div>
           
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="validationCustom01" name="last_name" required>
            <div class="invalid-feedback">
                Input Required
            </div>
        </div>

        <div class="col-md-4 p-2">
        <label for="validationCustom01" class="form-label">Gender:</label>
            <div class="row g-2 border bg-white">
                <div class="col-5">
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male">
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female">
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    Gender Required
                </div>
            </div>
        </div>
        

        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="validationCustom01" name="date_of_birth" required>
            <div class="invalid-feedback">
                Input Required
            </div>
        </div>

        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" id="validationCustom01" name="mobile_number" pattern="[+][6]{1}[3]{1}[0-9]{10}" placeholder="+63" required>
            <div class="invalid-feedback">
                Input Required
                or use correct format
            </div>
        </div>

        <div>
            <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr"></div>
        </div>
        
        <div class="col-12">
            <input class="btn btn-primary" type="submit" name="register" value="Register">
        </div>
    </form>
        <br>
        <div class="p-4">
            <!---kapag na click ko to pupunta ako sa login page-->
            <a href="login.php">Have an account? Log in</a>
        </div>
</div>

    <?php

  
     //registration
     if(isset($_POST['register']) && $_POST['g-recaptcha-response'] != "" ){

        $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
        $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
        $response_data = json_decode($verify_response);
    
        if($response_data->success){
            $email = $_POST['email'];
            
            $account_id = "2021" .  rand('000000', '999999');   
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
        
            $gender = $_POST['gender'];
            $date_birth  = $_POST['date_of_birth'];
            $mobile_number = $_POST['mobile_number'];
        
            // verification key na hindi makikita sa database kase naka hash sya or encrypted 
            // kung baga dun sa email nya ikaw lang makaka access nyan
            $vkey = md5(rand('10000' , '9999'));
            $email_status = 0 ;
            
            
            // time zone kase kung anong oras sya nag create netong profile
            // date & time 
            // Hour Minutes Secods
            date_default_timezone_set("Asia/Manila");
            $time= date("h:i:s", time());
            //year month date
            $date = date('y-m-d');

            
            if(strlen($mobile_number) > 13 || strlen($mobile_number) < 13){
            
                echo "<h4>" . "Mobile Number is Invalid" . "</h4>";
                exit();
            
            }
        
            if(strpos($mobile_number,"+63") !== FALSE){
                
            }else{
            
                echo "<h4>" . "Mobile Number is Invalid2" . "</h4>";
                exit();
                
            }
            //user id ito ng doctor
            $secretary = "secretary";
        
            //validation ng email
            // kung naka register na tong email na to sa database di na sya makakapasok for registration 
            // kase already registered na sya
            $query_email = "SELECT * FROM users WHERE email='$email'";
            $run_email = mysqli_query($conn,$query_email);
            if(mysqli_num_rows($run_email) > 0){
                echo "<script>alert('Email already use')</script>";
            }else{
                $insert = "INSERT INTO users (doctor_or_secretary,email,account_id,first_name,last_name,gender,date_of_birth,mobile_number,v_code,email_status,date_time_created,
                date_time_updated,remarks) VALUES('$secretary','$email', '$account_id', '$first_name', '$last_name', '$gender','$date_birth',
                '$mobile_number', '$vkey', '$email_status', '$date $time', '$date $time', NULL)";
                $run_insert = mysqli_query($conn,$insert) && sendMail($email,$vkey,$account_id);

                if($run_insert){
                    echo "Data Inserted";
                }else{
                    echo "error sa pag insert". $conn->error;
                }
            }
        }
        echo "" . $conn->error ; 
}
    ?>
<script src="js/bootstrap.js"></script>
</body>
</html>


