<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <title>Online Appointment System</title>
    <link rel="stylesheet" href="../css/reg-users.css">
</head>
<body>

<div class="wrapper">
        <div class="navbar">
            <ul>
                <li>
                    <a href="homepage.php">Home</a>
                    <a href="#">About</a>
                    <a href="#">Doctors</a>
                    <a href="">Secretary</a>
                </li>
            </ul>
        </div>
    </div> 
 
<!--yan nagana na yan hahaha-->
    <div class="logo">
        <img src="../css/logo.png" alt="Logo" >
    </div>

   <?php    
   session_start();
 include('../connection.php');
    //gumamit ako ng php mailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    // nilagay ko dito yung mga info ng user, email, verification code , at account id nya
    // mag sesend ito sa email nya
    function sendMail($email,$vkey,$final_Account_id){
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
            $mail->Body    = "Thanks for registration ! Hello $email welcome to <b> NGH </b> 
            this is your account id '$final_Account_id'
            Click the link to verify the email address. Thank you so much! ♥ 
            <a href='http://localhost/OTP/users/verify.php?email=$email&v_code=$vkey&account_id=$final_Account_id'>Verify</a>' " ;
           
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
        
    }

    $error = NULL;

   
    ?>
<div class="container">
    <form action="#" method="POST">
        <!-----sign up nya-->
        <!--yung nasa NAME na input yan yung mga inputed data na ipapasok sa database-->
        <!--gumamit ng POST method para ma secure yung pag input sa DB--->
        <h3>Sign up</h3>
        <label for="">Email:</label>
        <input type="email" name="email"> <br>
        <label for="">First Name:</label>
        <input type="text" name="first_name"> <br>
        <label for="">Last Name:</label>
        <input type="text" name="last_name"> <br>
        <label for="">Age: </label>
        <input type="number" name="age" > <br>
        <label for="">Gender: </label>
        <select name="gender" id="" required>
            <option value="">-Select-</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select> <br>
        <label for="">Date of Birth:</label> 
        <input type="date" name="date_of_birth">  <br>
        <label for="">Phone Number:</label>
        <input type="text" name="mobile_number" placeholder="+63" title="use international number"> <br>
        
        <!---dito naman sa check box, array to. so kung baga kung ano yung ma check nya 
        yun yung mailalagay sa database na profession nya--><br>
        <input type="checkbox" name="profession[]" class="profession_lists" value="doctor" > Check if you are a doctor  <br>
        <input type="checkbox" name="profession[]" class="profession_lists"   value="secretary" > Check if you are secretary <br>

        <br>
        <div class="register">
        <!--kapag na pindot mo naman tong register button so papasok na to sa loob ng database-->
        <input type="submit" name="register" value="Register">
        </div>

    </form>
 </div> <br>
    <div class="login">
        <!---kapag na click ko to pupunta ako sa login page-->
        <a href="login.php">Have an account? Log in</a>
    </div>

    <?php

  
     //registration
     if(isset($_POST['register'])){
         //finetch natin lahat ng data nya using POST METHOD
        $email = $_POST['email'];
        
        $account_id = rand('000000', '999999');

        $final_Account_id = $account_id;
       
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $date_birth  = $_POST['date_of_birth'];
        $phone_number = $_POST['mobile_number'];
       
        // verification key na hindi makikita sa database kase naka hash sya or encrypted 
        // kung baga dun sa email nya ikaw lang makaka access nyan
        $vkey = md5(rand('10000' , '9999'));
        $email_status = 0 ;
        error_reporting(E_ERROR | E_PARSE);
        $profession = $_POST['profession'];

        if(empty($profession)){
            echo "Please Select Profession";
            exit();
        }

       // time zone kase kung anong oras sya nag create netong profile
       // date & time 
       // Hour Minutes Secods
        date_default_timezone_set("Asia/Manila");
        $time= date("h:i:s", time());
        //year month date
        $date = date('y-m-d');

        if(strpos($phone_number,"+63") !== FALSE){
            echo "valid";
            
        }else{
            echo "Please use international format" ;
            exit();
        }
        //user id ito ng doctor
        
        

        //validation ng email
        // kung naka register na tong email na to sa database di na sya makakapasok for registration 
        // kase already registered na sya
        $query_email = "SELECT * FROM users WHERE email='$email'";
        $run_email = mysqli_query($conn,$query_email);
        if(mysqli_num_rows($run_email) > 0){
            echo "<script>alert('Email already use')</script>";
        }else{
            //insert into database

            //gumamit ako ng foreach sa profession para makuha yung array na chineck nya
            // AS meaning nan Alias kung baga
            foreach($profession as $prof){
                // papasok sa database lahat ng ininput na data
                
                $user_form = "INSERT INTO users (doctor_or_secretary,email,account_id,first_name,last_name,age,gender,date_of_birth,mobile_number,v_code,email_status,date_time_created,date_time_updated,remarks)
                VALUES ('$prof','$email','$final_Account_id' ,'$first_name' ,'$last_name' , '$age' , '$gender' , '$date_birth' , '$phone_number', '$vkey' , '$email_status' ,'$date  $time' ,'$date $time', NULL)";
                //call out yung query , then isama si sendMail para ma valid yung email.
            
                $run_form = mysqli_query($conn,$user_form)  && sendMail($_POST['email'],$vkey,$final_Account_id);
                echo "sucess user ";
                // kung gumana sya edi goods 
                // kung check nya is secretary mapupunta sa user_type yung ID ni secretary
                if($run_form){
                    //dito sa part na to yun!!!  
                    // mag auto increment yang ID nya and then maari mo makita sa database yung ID nya
                    // naka hyper link yun
                    foreach($profession as $user_id){
                        //user id ito ng secretary
                        
                        // so since secretary sya papasok to sa user_Type table na sinasabi ko 
                        if($user_id == 'secretary'){
                            $query_secretary = "INSERT INTO user_type (user_id,date_time_created,date_time_updated,remarks)
                            VALUES ('$final_Account_id','$date $time','$date $time', NULL)";
                            $run_secretary = mysqli_query($conn,$query_secretary);
                            echo "<script>alert('Registration Success') </script>";
                        }else{
                            //kukunin ko yung info ni doc
                            //after ko makuha info ni doc sa users gamit yung EMAIL na ginamit nya
                            $query_users = "SELECT * FROM users WHERE email='$email'";
                            $run_users = mysqli_query($conn,$query_users);

                            if($run_users){
                                if(mysqli_num_rows($run_users) > 0){
                                    $result_fetch = mysqli_fetch_assoc($run_users);

                                    if($result_fetch['account_id']){
                                        $_SESSION['account_id'] = $result_fetch['account_id'];
                                        header("Location: fill-up.php");
                                    }
                                }
                            }
                        }
                    }
                
                }else{
                    echo "<script>alert('Error: Something Went Wrong')</script>";
                }
            
            }
        
        }

    }

    echo "" . $conn->error ; 
    ?>
    
    
   
</body>
</html>

<script type="text/javascript">
   $('.profession_lists').click(function(){
    $(this).siblings('input:checkbox').prop('checked', false);
   });
</script>