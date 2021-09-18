<?php

include('connection.php');
session_start();
$email = $_SESSION['email'];
$mobile_number = $_SESSION['mobile_number'];
echo $mobile_number;
echo $email;
$first_name=$_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>     
    $(function() {
        var date_today = new Date();
        $( "#datepicker" ).datepicker({
            minDate: date_today,
            beforeShowDay: function(d) {
                
                var day = d.getDay()
                return [(day != 0 && day != 1)];
            }
        });
    });
    </script>
</head>
<body>
    <h3>Doctor</h3>
    <a href="home.php">Back</a> <br>


    <?php

        $id = $_GET['id'];

        $select_doctors_Details = "SELECT users.first_name,users.last_name,users.mobile_number, users.id, doctors_details.user_id,
        doctors_details.specialization, doctors_details.internship, doctors_details.residency,
        doctors_details.hmo, doctors_details.doc_picture
        FROM users
        LEFT JOIN doctors_details ON users.id = doctors_details.user_id WHERE users.id = '$id'";
        $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);


        if(mysqli_num_rows($run_doctors_Details) > 0){
            foreach($run_doctors_Details as $row){
                ?>
                <form action="" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Specialization</th>
                                <th>Internship</th>
                                <th>Residency</th>
                                <th>HMO</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="name_of_doctor" value="<?php echo $row ['first_name'] . $row ['last_name']?>" readonly></td>
                                <td><img src="<?php echo "users/doc_picture/" . $row ['doc_picture'] ?>" width="100px" alt="Image"></td>
                            
                                <td><?php echo $row ['specialization']?></td>
                                <td><?php echo $row ['internship']?></td>
                                <td><?php echo $row ['residency']?></td>
                                <td><?php echo $row ['hmo']?></td>
                                <td><input type="hidden" name="id_doctor" value="<?php echo $row ['id']?>"></td>
                            </tr>
                        </tbody>
                    </table>
                   
                        <label for="">Click to Select Date</label><br>
                        <i class="fa fa-calendar" style="font-size:28px"></i> <input type="text" name="appointment_date" id="datepicker" readonly>
                            <select name="appointment_time" id="">
                                <option value="9:00am - 9:30am">9:00am - 9:30am</option>
                                <option value="10:00am - 10:30am">10:00am - 10:30am</option>
                                <option value="11:00am -11:30am">11:00am -11:30am</option>
                                <option value="12:00pm - 12:30pm">12:00pm - 12:30pm</option>
                                <option value="1:00pm - 1:30pm">1:00pm - 1:30pm</option>
                                <option value="2:00pm - 2:30pm">2:00pm - 2:30pm</option>
                                <option value="3:00pm - 3:30pm">3:00pm - 3:30pm</option>
                                <option value="4:00pm - 4:30pm">4:00pm - 4:30pm</option>
                            </select>
                        <input type="submit" name="book_appointment" value="Book Appointment">
                </form>
                <?php
            }
        }

    ?>
    
</body>
</html>

<?php

/*
require_once __DIR__.'/vendor/autoload.php';
*/
if(isset($_POST['book_appointment'])){

    //dito ko din i sesend yung sms notification nya
    $name_of_doctor = $_POST['name_of_doctor'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $name_of_patient = $_SESSION['first_name'] . " " . $_SESSION['last_name'];

    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    $date = date('y-m-d');

    $id_doctor = $_POST['id_doctor'];
    $remarks = "Pending Appointment";

    $msg = "Hi! this is your appointment details from Novaliches General Hospital. 
    Your appointment date & time is on $appointment_date $appointment_time , and your doctor is $name_of_doctor please go to your appointment schedule on time. Thank you so much! ";

    $query_appointments = "INSERT INTO appointments (appointment_date,appointment_time,id_doctor,name_of_secretary,
    name_of_patient,date_time_created,date_time_updated,remarks) VALUES 
    ('$appointment_date' , '$appointment_time' , '$id_doctor' , NULL , '$name_of_patient', '$date $time',  NULL ,'$remarks')";
    $run_appointments = mysqli_query($conn,$query_appointments); 

    if($run_appointments){

        // eto na lang eedit ko hahahahahaha 
      echo "sucess";
    
      /*
      $messagebird = new MessageBird\Client('hzPlSRE4OFahwg9ZI80xfqhpr');
      $message = new MessageBird\Objects\Message;
        $message->originator = '+639614507751';
        $message->recipients = $mobile_number;
        $message->body = $msg;
        $response = $messagebird->messages->create($message);
        echo "sucess";
        */
        
      
    }else{
        echo "error" . $conn->error;
    }
}

?>
