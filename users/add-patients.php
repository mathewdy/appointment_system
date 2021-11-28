<?php

include('../connection.php');
session_start();

if(isset($_POST['add_patient'])){
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $hmo = $_POST['hmo'];
    $date_of_birth = $_POST['date_of_birth'];
    $mobile_number = $_POST['mobile_number'];
    $gender = $_POST['gender'];
    $patient_id = "2020" . rand('00000', '99999');
    $password = "empty" . rand('111', '222');
    

    $vcode=" ";
    $email_status= "0";


    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    //year month date
    $date = date('y-m-d');

    $query = "INSERT INTO patients (email,password,first_name,last_name,age,gender,
    date_of_birth,mobile_number,hmo,patient_id,v_code,email_status,date_time_created,date_time_updated,remarks) 
    VALUES ('$email' ,'$password' , '$first_name' , '$last_name', '$age' , '$gender', '$date_of_birth' , '$mobile_number', '$hmo', '$patient_id',
    '$vcode' , '$email_status' , '$date $time' , '$date $time' ,NULL) " ;
    $run_query = mysqli_query($conn,$query);

    if($run_query){
        echo "<script>alert('Added info') </script>";
        echo "<script>window.location.href='home.php'</script>";
    }else{
        echo "error" . $conn->error;
    }

}
?>
