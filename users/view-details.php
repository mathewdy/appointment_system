<?php

include('../connection.php');
session_start();


if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $appointment_date = $_POST['appointment_date'];

    $remarks = $_POST['remarks'];
    $name_of_patient = $_POST['name_of_patient'];
    $appointment_time = $_POST['appointment_time'];

    $date_time_created = $_POST['date_time_created'];

    $id_doctor = $_POST['id_doctor'];

    echo $id . '<br>';
    echo $appointment_date . '<br>';
    echo $remarks;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="view-appointment.php">Back</a>
    <h2>Details</h2>
    
    <form action="" method="POST">
        <label for=""> <b> Edit Remark: </b> </label> <p><?php echo $remarks?></p> 
        <select name="remarks" id="">
            <option value="Pending Appointment">Pending Appointment</option>
            <option value="Patient Arrived">Patient Arrived</option>
            <option value="Cancelled">Cancelled</option>
        </select> <br>
        <label for="">Date & Time Appointment Created</label>
        <input type="text" name="date_time_created" value="<?php echo $date_time_created?>" readonly><br>

        <label for="">Appointment Date</label>
        <input type="text" name="appointment_date" value="<?php echo $appointment_date?>" readonly> <br>

        <label for="">Appointment Time</label>
        <input type="text" name="appointment_time" value="<?php echo $appointment_time?>" readonly> <br>
        <label for="">Name of Patient</label>
        <input type="text" name="name_of_patient" value="<?php echo $name_of_patient?>"> <br>
        <!---id number ng appointment date-->
        <input type="hidden" name="id" value="<?php echo $id?>">
        <input type="hidden" name="id_doctor" value="<?php echo $id_doctor?>">
        <input type="submit" name="update" value="Update">
    </form>
    

</body>
</html>

<?php


if(isset($_POST['update'])){

    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    $date = date('y-m-d');

    $appointment_date = ($_POST['appointment_date']);
    $appointment_time = $_POST['appointment_time'];
    $date_time_created = $_POST['date_time_created'];
    $id = $_POST['id'];
    
    $id_doctor = $_POST['id_doctor'];
    $name_of_secretary = $secretary;
    $name_of_patient = $_POST['name_of_patient'];

    $remarks = $_POST['remarks'];

    $query = "UPDATE appointments SET appointment_date='$appointment_date' , appointment_time='$appointment_time',
    user_id='$id_doctor' , name_of_secretary = '$name_of_secretary' , name_of_patient='$name_of_patient',
    date_time_created = '$date_time_created' , date_time_updated = '$date $time' , remarks='$remarks'
    WHERE id = '$id'";

    $run  = mysqli_query($conn,$query);

    if($run){
        echo ("<script>window.alert('Succesfully Updated'); window.location.href='view-appointment.php';</script>");
    }else{
        echo "<script>alert('Something went wrong'); </script>";
    }
}

?>