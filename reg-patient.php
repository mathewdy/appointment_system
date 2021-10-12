<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Appointment System</title>
</head>
<body>
    
   <?php
    include('connection.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function sendMail($email,$vkey){
        require ("PHPMailer.php");
        require("SMTP.php");
        require("Exception.php");

        $mail = new PHPMailer(true);

        try {
            //Server settings
           
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mathewmelendez123123@gmail.com';                     //SMTP username
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
            Click the link to verify the email address. Thank you so much! ♥ 
            <a href='http://localhost/OTP/verify.php?email=$email&v_code=$vkey'>Verify</a>' " ;
           
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
        
    }


   session_start();

    $error = NULL;
    ?>  

    <form action="#" method="POST">
        <h3>Sign up</h3>
        <label for="">Email:</label>
        <input type="email" name="email"> <br>
        <label for="">Password: </label>
        <input type="password" name="password"> <br>
        <label for="">Repeat Password: </label>
        <input type="password" name="password2"> <br>
        <label for="">First Name:</label>
        <input type="text" name="first_name"> <br>
        <label for="">Last Name:</label>
        <input type="text" name="last_name"> <br>
        <label for="">Age: </label>
        <input type="number" name="age"> <br>
        <label for="">Gender: </label>
        <select name="gender" id="" required>
            <option value="">-Select-</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select> <br>
        <label for="">Date of Birth:</label> 
        <input type="date" name="date_of_birth">  <br>
        <label for="">Phone Number:</label>
        <input type="text" name="mobile_number" value="+63"> <br>
        <label for="">HMO:</label>
        <input type="text" name="hmo" > <br>
        <input type="submit" name="register" value="register">

    </form>
    <!---kapag na click ko to pupunta ako sa login page-->
    <a href="login-patient.php">Log in Patient</a>
 
    <?php

     //registration
     if(isset($_POST['register'])){
        $email = $_POST['email'];
        $password = ($_POST['password']);
        $password2 = ($_POST['password2']);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $date_birth  = $_POST['date_of_birth'];
        $phone_number = $_POST['mobile_number'];

        date_default_timezone_set("Asia/Manila");
        $time= date("h:i:s", time());
        $date = date('y-m-d');
       

        $hmo = $_POST['hmo'];

      
        //validation ng email
        $vkey = md5(rand('10000' , '9999'));
        $email_status = 0 ;
        //validation ng email
        $query_email = "SELECT * FROM patients WHERE email='$email'";
        $run_email = mysqli_query($conn,$query_email);

        if(mysqli_num_rows($run_email) > 0){
            echo "<script>alert('Email already use')</script>";
        }elseif($phone_number == 11){
            echo "numbers must be 11";
        }elseif($password != $password2){
          echo "<script>alert('Password Incorrect')</script>";
        }else{
            //insert into database 
            $patient_form = "INSERT INTO patients (email,password,first_name,last_name,age,gender,date_of_birth,mobile_number,v_code,email_status,date_time_created,date_time_updated,remarks)
            VALUES ('$email' ,'$password' ,'$first_name' ,'$last_name' , '$age' , '$gender' , '$date_birth' , '$phone_number', '$vkey' , '$email_status' ,'$date  $time', '$date $time', NULL )";
            //call out yung query , then isama si sendMail para ma valid yung email.
            $run_form = mysqli_query($conn,$patient_form) && sendMail($_POST['email'], $vkey);
            if($run_form){

                //foreign key
                $patient_id = $conn->insert_id;

                $patient_details = "INSERT INTO patient_details (patient_id,hmo,date_time_created,date_time_updated,remarks) VALUES
                ('$patient_id' , '$hmo' , '$date  $time ', '$date $time' , NULL)";
                $run_details = mysqli_query($conn,$patient_details);

                if($run_details){
                    echo "<script>alert('Registration Successful')</script>";
                    echo "<script>window.location.href='login-patient.php' </script>";
                    
                }

                
            }else{
                echo "<script>alert('Error: Something Went Wrong')</script>";
            }
        }

    }

    echo "" . $conn->error ; 
    ?>
    
   
</body>
</html>