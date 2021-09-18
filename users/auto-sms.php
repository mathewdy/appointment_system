<?php


include('connection.php');


// DI PA TO TAPOS
//AT DI SURE
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<body>
    <h2>Auto Sms</h2>
    <form action="#" method="POST">
    <?php

        // id doctor 1
        $send_date = date('y-m-d');
        echo $send_date . '<br>';
        $query_total_patients = "SELECT COUNT(id_doctor) AS number_of_patients , users.mobile_number 
        FROM appointments 
        LEFT JOIN users ON appointments.id_doctor = users.id WHERE appointment_date = '$send_date' AND id_doctor = 1";
        $run_total_1 = mysqli_query($conn,$query_total_patients);

        if(mysqli_num_rows($run_total_1) > 0){
            foreach ($run_total_1 as $row){
                ?> 
                    <label for="">number ng patients (today)</label>
                    <div id="content">
                    <input type="text" name="number_of_patients_1" value="<?php echo $row['number_of_patients']?>">
                    </div>

                    <label for="">mobile number ni doc 1</label>
                    <div id="content">
                    <input type="text" name="mobile_number_1" value="<?php echo $row ['mobile_number']?>">
                    </div>
                <?php
            }
        }
            // id doctor 3
        $query_total_patients = "SELECT COUNT(id_doctor) AS number_of_patients , users.mobile_number 
        FROM appointments 
        LEFT JOIN users ON appointments.id_doctor = users.id WHERE appointment_date = '$send_date' AND id_doctor = 3";
        $run_total_1 = mysqli_query($conn,$query_total_patients);

        if(mysqli_num_rows($run_total_1) > 0){
            foreach ($run_total_1 as $row){
                ?>  
                    <label for="">number ng patients (today)</label>
                    <div id="content">
                    <input type="text" name="number_of_patients_3" value="<?php echo $row['number_of_patients']?>">
                    </div>

                    <label for="">mobile number ni doc 3</label>
                    <div id="content">
                    <input type="text" name="mobile_number_3" value="<?php echo $row ['mobile_number']?>">
                    </div>
                <?php
            }
        }
        $query_total_patients = "SELECT COUNT(id_doctor) AS number_of_patients , users.mobile_number 
        FROM appointments 
        LEFT JOIN users ON appointments.id_doctor = users.id WHERE appointment_date = '$send_date' AND id_doctor = 4";
        $run_total_1 = mysqli_query($conn,$query_total_patients);

        if(mysqli_num_rows($run_total_1) > 0){
            foreach ($run_total_1 as $row){
                ?> 
                    <label for="">number ng patients (today)</label>

                    <div id="content">
                    <input type="text" name="number_of_patients_4" value="<?php echo $row['number_of_patients']?>">
                    </div>

                    <label for="">mobile number ni doc 1</label>
                    <div id="content">
                    <input type="text" name="mobile_number_4" value="<?php echo $row ['mobile_number']?>">
                    </div>
                <?php
            }
        }

    ?>
    
    
    <input type="submit" value="send" name="send" id="send" onclick="refresh()">
  
  
    </form>
</body>
</html>



<script>
    function refresh(){
        $('#contnet').load(location.href + "#content");
    }
</script>


<?php

$number_of_patients1 = $_POST['number_of_patients_1'];
echo $number_of_patients1 . '<br>';
$mobile_number_1 = $_POST['mobile_number_1'];
echo $mobile_number_1.  '<br>';

$number_of_patients3 = $_POST['number_of_patients_3'];
echo $number_of_patients3 .  '<br>';
$mobile_number_3 = $_POST['mobile_number_3'];
echo $mobile_number_3.  '<br>';

$number_of_patients4 = $_POST['number_of_patients_4'];
echo $number_of_patients4 .  '<br>';
$mobile_number_4 = $_POST['mobile_number_4'];
echo $mobile_number_4.  '<br>';



$query = "INSERT INTO sample (number_of_patients_1,mobile_number_1,number_of_patients_3,mobile_number_3,number_of_patients_4,
    mobile_number_4) VALUES ('$number_of_patients1' , '$mobile_number_1' , '$number_of_patients3' , '$mobile_number_3',
    '$number_of_patients4', '$mobile_number_4')";
    $run = mysqli_query($conn,$query);

    if($run){
        echo "added to db";
    }else{
        echo "error" .$conn->error;
    }


?>