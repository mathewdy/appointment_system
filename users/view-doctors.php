<?php
include('../connection.php');

session_start();


if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$num_per_age = 05;
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
    <a href="home.php">Back</a>
        <div class="jumbotron">
            <h2>Doctor's Info</h2>
            <div class="card">
                <div class="card-body">
                    <label for="search">Search Doctor</label> <br>
                    <input type="text" id="search_doctor" autocomplete="off" placeholder="Search">
                    <br>
                    <br>
                    <table id="data_table" class="table table-hover table-primary table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Account ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Specialization</th>
                                <th></th>
                                <th>Options</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php

                                $query= "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id WHERE doctor_or_secretary ='doctor' LIMIT $start_from, $num_per_age";
                                $run_query = mysqli_query($conn,$query);

                                if($run_query){
                                    if(mysqli_num_rows($run_query)){
                                        foreach($run_query as $row){
                                            ?>

                                               <tr>
                                                   <td><?php echo $row ['account_id']?></td>
                                                   <td><?php echo $row ['first_name']?></td>
                                                   <td><?php echo $row ['last_name']?></td>
                                                   <td><?php echo $row ['specialization']?></td>
                                                   <td>
                                                       <a href="view-doctors-profile.php?account_id=<?php echo $row ['account_id']?>" class="btn btn-info">View</a>
                                                   </td>
                                                   <td>
                                                       <a href="edit-doctors-profile.php?account_id=<?php echo $row ['account_id']?>" class="btn btn-secondary">Edit</a>
                                                   </td>
                                                   <td>
                                                       <a href="delete-doctors-profile.php?account_id=<?php echo $row ['account_id']?>" class="btn btn-danger">Delete</a>
                                                   </td>
                                               </tr>


                                            <?php
                                        }
                                    }
                                }

                            ?>
                        </tbody>
                    </table>
                
                    <?php

                        $pr_query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id WHERE doctor_or_secretary ='doctor'";
                        $pr_results = mysqli_query($conn,$pr_query);
                        $total_record = mysqli_num_rows($pr_results);
                      
                        $total_page = ceil($total_record/$num_per_age);
                      

                        if($page > 1 ){
                            echo  "<a href='view-doctors.php?page=".($page-1)."' class='btn btn-danger'>Previous</a> ";
                        }
                        
                        for($i=1;$i<$total_page;$i++){
                            echo  "<a href='view-doctors.php?page=".$i."' class='btn btn-primary'>$i</a> ";
                        }

                        if($i > $page ){
                            echo  "<a href='view-doctors.php?page=".($page+1)."' class='btn btn-danger'>Next</a> ";
                        }
                    ?>
                </div>
            </div>
        </div>
        
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
       $("#search_doctor").on("keyup",function(){
            var search = $(this).val();
            $.ajax({
                url: "search2.php",
                type: "POST",
                data: {search: search},
                success: function(data){
                    $("#data_table").html(data);
                }
            });
       });
    });
</script>
</body>
</html>


