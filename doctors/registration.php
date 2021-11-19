<?php
//doctors 
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
          $mail->Password   = 'mathewpogi123';                               //SMTP password
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
           <a href='http://localhost/appointment_system/doctors/verify.php?email=$email&v_code=$vkey'>Verify</a>' 
           This is your account id '$account_id' Have a great day." ;

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <h2>Registration</h2>
    <form action="" method="POST" enctype="multipart/form-data" onsubmit="return myfunc()">
    <label for="">First Name</label>
    <input type="text" name="first_name">
    <label for="">Last Name</label>
    <input type="text" name="last_name"> <br>
    <label for="">Date of Birth</label>
    <input type="date" name="date_of_birth" id=""><br>
    <label for="">Email Address</label>
    <input type="email" name="email"> <br>
    <label for="">Gender</label>
    <input type="radio" name="gender" value="Female"> Male
    <input type="radio" name="gender" value="Male">  Female <br>
    <label for="">Mobile Number</label>
    <input type="text" name="mobile_number" id="mobile_num" > <br>

    <select name="specialization" id="">
        <option value="">-Select-</option>
        <option value="Allergy and immunology">Allergy and immunology</option>
        <option value="Anesthesiology">Anesthesiology</option>
        <option value="Dermatology">Dermatology</option>
        <option value="Diagnostic radiology">Diagnostic radiology</option>
        <option value="Emergency medicine">Emergency medicine</option>
        <option value="Family medicine">Family medicine</option>
        <option value="Internal medicine">Internal medicine</option>
        <option value="Medical genetics">Medical genetics</option>
        <option value="Neurology">Neurology</option>
        <option value="Nuclear medicine">Nuclear medicine</option>
        <option value="Obstetrics and gynecology">Obstetrics and gynecology</option>
        <option value="Ophthalmology">Ophthalmology</option>
        <option value="Pathology">Pathology</option>
        <option value="Pediatrics">Pediatrics</option>
        <option value="Physical medicine and rehabilitation">Physical medicine and rehabilitation</option>
        <option value="Preventive medicine">Preventive medicine</option>
        <option value="Psychiatry">Psychiatry</option>
        <option value="Radiation oncology">Radiation oncology</option>
        <option value="Surgery">Surgery</option>
        <option value="Urology">Urology</option>
    </select> <br>
    <label for="">PRC ID</label>
    <input type="file" name="prc_id"> <br>
    <label for="">Internship</label>
    <input type="text" name="internship"> <br>
    <label for="">Residency</label>
    <input type="text" name="residency"> <br>
    <label for="">HMO</label>
    <input type="text"name= "hmo"> <br>
    <label for="">Profile Picture</label>
    <input type="file" name="doc_picture"> <br>
    <div>
        <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr"></div>
    </div>
    <input type="submit" name="register" value="Register">
    </form> <a href="login.php">Already have account?</a>
</body>
</html>

<?php

if(isset($_POST['register']) && $_POST['g-recaptcha-response'] != "" ){
    $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
    $response_data = json_decode($verify_response);

    if($response_data->success){

        $doctor = "doctor"; 
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        
        
        $date_of_birth = $_POST['date_of_birth'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile_number = $_POST['mobile_number'];
        $specialization = $_POST['specialization'];
    
        $internship = $_POST['internship'];
        $residency = $_POST['residency'];
        $hmo = $_POST['hmo'];
        
        $prc_id = $_FILES['prc_id']['name'];
        $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
        $filename = $_FILES ['prc_id']['name'];
        $file_extension = pathinfo($filename , PATHINFO_EXTENSION);
    
        $account_id = "2021" . rand('00000', '99999');
        $vkey = md5(rand('10000' , '9999'));
    
        
        date_default_timezone_set("Asia/Manila");
        $time= date("h:i:s", time());
        //year month date
        $date = date('y-m-d');
    
        $validation = "SELECT * FROM users WHERE email = '$email'";
        $run_validation = mysqli_query($conn,$validation);
    
        $doc_picture = $_FILES['doc_picture']['name'];
        $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
        $filename = $_FILES ['doc_picture']['name'];
        $file_extension = pathinfo($filename , PATHINFO_EXTENSION);
    
        if(mysqli_num_rows($run_validation) > 0){
            echo "<script>alert('Email already use')</script>";
            exit();
        }
    
        if(!in_array($file_extension, $allowed_extension)){
            echo "image not added"  ;
           exit();
        }else{
            $insert = "INSERT INTO users (doctor_or_secretary,email,account_id,first_name,last_name,gender,date_of_birth,mobile_number,v_code)
            VALUES ('$doctor', '$email', '$account_id', '$first_name', '$last_name', '$gender', '$date_of_birth', '$mobile_number', '$vkey')";
            $run_insert = mysqli_query($conn,$insert) && sendMail($email,$vkey,$account_id);
            if($run_insert){
                echo "added data , doctor";
                $insert2 = "INSERT INTO doctors_details (user_id,specialization,prc_id,internship,residency,hmo,doc_picture,date_time_created,date_time_updated,remarks)
                VALUES ('$account_id', '$specialization', '$prc_id', '$internship', '$residency', '$hmo', '$doc_picture', '$date $time', '$date $time', NULL)";
                $run_insert2 = mysqli_query($conn,$insert2);
                move_uploaded_file($_FILES["prc_id"]["tmp_name"], "prc_id/" . $_FILES["prc_id"] ["name"]);
                move_uploaded_file($_FILES["doc_picture"]["tmp_name"], "profile_picture/" . $_FILES["doc_picture"] ["name"]);
    
                if($run_insert2 ){
                    echo "added data, doctor2";
                }else{
                    echo "error insert2" . $conn->error;
                }
            }else{
                echo "error insert1". $conn->error;
            }
        }
    }

   

}
// di pa tapos
?>


<script>
(function () {
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