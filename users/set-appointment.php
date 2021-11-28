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
    <a href="appointment.php">Back</a>
    <div class="card">
        <div class="card-body">
            <label for="search">Search</label>
            <input type="text"  id="search_patient"  class="form-control" placeholder="Search Patient" style="width: 300px;">
            <div class="result">

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="table-responsive">
        <div class="col-md-2"></div>
            <table class="table table-responsive table-bordered caption-top border border-success border-4 " id="table_data">
                <caption style="font-size: 20px;">List of Patients</caption>
                    <thead>
                        <tr>
                            <th scope="col">Patient ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Set Appointment</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $query = "SELECT * FROM patients LIMIT $start_from , $num_per_page";
                            $run = mysqli_query($conn,$query);

                            if(mysqli_fetch_assoc($run) > 0){
                                foreach($run as $row){
                                ?>
                                <tbody>
                                    <tr>
                                        <td><b> <?php echo $row ['patient_id']?></b> </td>
                                        <td><?php echo $row ['first_name']?></td>
                                        <td><?php echo $row ['last_name']?></td>
                                        <td>
                                            <a href="set-patient.php?patient_id=<?php echo $row ['patient_id']?>">Set Appointment</a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                }
                            }
                        ?>
                    </tbody>
            </table>
            <?php

                    $pr_query = "SELECT * FROM patients";
                    $pr_result = mysqli_query($conn,$pr_query);
                    $total_record = mysqli_num_rows($pr_result);
                   
                    $total_page = ceil($total_record / $num_per_page);

                    if($page > 1 ){
                        echo  "<a href='set-appointment.php?page=".($page-1)."' class='btn btn-danger'>Previous</a> ";
                    }

                    for($i=1;$i<$total_page;$i++){

                        echo  "<a href='set-appointment.php?page=".$i."' class='btn btn-primary'>$i</a> ";
                    }

                     if($i > $page ){
                        echo  "<a href='set-appointment.php?page=".($page+1)."' class='btn btn-danger'>Next</a> ";
                    }

                ?>
        </div>
    </div>
<!-----------set appointment---------->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script>
    $(document).ready(function(){
       $("#search_patient").on("keyup",function(){
            var search = $(this).val();
            $.ajax({
                url: "search-patient.php",
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
