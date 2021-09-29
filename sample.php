<?php
//auto insert

include('connection.php');

/*

$query = "SELECT * FROM patients";
$run = mysqli_query ($conn,$query);




if(mysqli_num_rows($run) > 0){
    foreach($run as $row){
        $first_name = $row ['first_name'] . "<br>";
        $last_name = $row ['last_name'];
        echo $last_name;
        echo $first_name;
        
        
            $insert = "INSERT INTO sample (first_name) VALUES ('$first_name')";
            $run_insert = mysqli_query($conn,$insert);

            if($run_insert == TRUE ){
                echo "added";
            }else{
                echo "error " . $conn->error;
            }
        
    }
}

*/


//since nagawa ko yung sa taas try ko naman mag insert sa db

// kukunin ko naman yung number ng doctor


// so since gumagana na to, automatic na syang papasok sa SMS (pati sa DB) , since walang mga laman yung mga patient nya 
// hindi yun mag tetext sa number or hindi sya papasok sa db

$date = date('y-m-d');

echo $date . '<br>';

$query = "SELECT appointments.appointment_date , doctors_details.user_id , appointments.id_doctor, users.mobile_number
FROM appointments 
LEFT JOIN doctors_details ON appointments.id_doctor =  doctors_details.user_id 
LEFT JOIN users ON appointments.id_doctor = users.id
WHERE appointments.id_doctor = 3 AND appointments.appointment_date = '$date'";
$run = mysqli_query($conn,$query);

$number_of_patients = mysqli_num_rows($run);

echo $number_of_patients . " number ng patients with in the date" . "<br>" . "<br>";



if(mysqli_fetch_assoc($run) > 0){
    foreach($run as $row){
        

             echo $appointment_date = $row ['appointment_date'] ;
             echo $id_doctor  =  $row ['id_doctor'] ;
             echo $mobile_number = $row ['mobile_number'];

             
            
             $insert = "INSERT INTO sample (number_of_patients,appointment_date,id_doctor,mobile_number)
             VALUES ('$number_of_patients' , '$appointment_date' , '$id_doctor' , '$mobile_number' )";
             $run_insert = mysqli_query($conn,$insert);

             if($run_insert == TRUE){
                 echo "added to database " . "<br>";
             }else{
                 echo "error " . $conn->error;
             }
        

    }
}






$query = "SELECT appointments.appointment_date , doctors_details.user_id , appointments.id_doctor, users.mobile_number
FROM appointments 
LEFT JOIN doctors_details ON appointments.id_doctor =  doctors_details.user_id 
LEFT JOIN users ON appointments.id_doctor = users.id
WHERE appointments.id_doctor = 1 AND appointments.appointment_date = '$date'";
$run = mysqli_query($conn,$query);

$number_of_patients = mysqli_num_rows($run);

echo $number_of_patients . " number ng patients with in the date" . "<br>" . "<br>";



if(mysqli_fetch_assoc($run) > 0){
    foreach($run as $row){
        

             echo $appointment_date = $row ['appointment_date'] ;
             echo $id_doctor  =  $row ['id_doctor'] ;
             echo $mobile_number = $row ['mobile_number'];

             
            
             $insert = "INSERT INTO sample (number_of_patients,appointment_date,id_doctor,mobile_number)
             VALUES ('$number_of_patients' , '$appointment_date' , '$id_doctor' , '$mobile_number' )";
             $run_insert = mysqli_query($conn,$insert);

             if($run_insert == TRUE){
                 echo "added to database " . "<br>";
             }else{
                 echo "error " . $conn->error;
             }
        

    }
}




?>