<?php

include('../connection.php');
session_start();


if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$num_per_page = 05;
$start_from = ($page-1)*05;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <a href="home.php">Back</a><br>
        <a href="set-appointment.php">Set Appointment</a><br>
        <a href="history-appointment.php">History</a>

        <h2>Appointments</h2>
        <div class="card">
            <div class="card-body">
                <label for="search">Search</label>
                <input type="text"  id="search_appointment"  class="form-control" placeholder="Search Appointment" style="width: 300px;">
                <div class="result">

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="table-responsive">
                <table class="table table-responsive table-striped table-hover caption-top" id="table_data">
                    <caption style="font-size: 20px;">List of Patients</caption>
                    <thead>
                        <tr>
                            <th scope="col">Appointment Date</th>
                            <th scope="col">Appointment Time</th>
                            <th scope="col">Name of Doctor</th>
                            <th scope="col">Name of Patient</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Update Appointment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                            $query = "SELECT * FROM appointments  LIMIT $start_from , $num_per_page";
                            $run = mysqli_query($conn,$query);

                            if(mysqli_num_rows($run) > 0){
                                foreach($run as $row){
                                    ?>
                                        <form class="row g-3 needs-validation" method="POST" action="update_appointment.php" novalidate>
                                        <tr>
                                            <td><?php echo $row ['appointment_date']?></td>
                                            <td><?php echo $row ['appointment_time']?></td>
                                            <td><?php echo $row ['name_of_doctor']?></td>
                                            <td><?php echo $row ['name_of_patient']?></td>
                                            <td><?php echo $row ['remarks']?></td>
                                            
                                            <td>
                                                <a href="update_appointment.php?patient_id=<?php echo $row['patient_id']?>" class="btn btn-primary">Update Appointment</a>
                                            </td>
                                        </tr>
                                    
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>

                <?php

                    $pr_query = "SELECT * FROM appointments";
                    $pr_result = mysqli_query($conn,$pr_query);
                    $total_record = mysqli_num_rows($pr_result);

                    $total_page = ceil($total_record / $num_per_page);

                    if($page > 1 ){
                        echo  "<a href='appointment.php?page=".($page-1)."' class='btn btn-danger'>Previous</a> ";
                    }

                    for($i=1;$i<$total_page;$i++){

                        echo  "<a href='appointment.php?page=".$i."' class='btn btn-primary'>$i</a> ";
                    }

                    if($i > $page ){
                        echo  "<a href='appointment.php?page=".($page+1)."' class='btn btn-danger'>Next</a> ";
                    }

                    ?>

            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script>
    $(document).ready(function(){
       $("#search_appointment").on("keyup",function(){
            var search = $(this).val();
            $.ajax({
                url: "search-appointment.php",
                type: "POST",
                data: {search: search},
                success: function(data){
                    $("#table_data").html(data);
                }
            });
       });
    });
</script> 

</body>
</html>


<?php

if(isset($_POST['update'])){
    $patient_id = $_POST['patient_id'];
    $update_appointment = $_POST['update_appointment'];

    if($update_appointment == 'Cancelled ')


    $query_update = "UPDATE appointments SET remarks = '$update_appointment' WHERE patient_id = '$patient_id'";
    $run_update = mysqli_query($conn,$query_update);

    if($run_update){
        echo "update";
    }else{
        echo "error" . $conn->error;
    }
}



?>