<?php

include('../connection.php');
session_start();
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];


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
            <h3>Welcome <?php echo $first_name . " " . $last_name ?> </h3>
            <a href="appointment.php"><i class="far fa-calendar-check"></i>Appointments</a> <br>
            <a href="view-doctors.php"><i class="fas fa-user-md"></i> View Doctors</a> <br>
            <a href="view-profile.php"><i class="fas fa-user-circle"></i>Profile</a> <br>
            <form action="logout.php" method="POST">
                <div class="col-12">
                    <input class="btn btn-info" type="submit" name="logout" value="Log Out">
                </div>
            </form>
            <div class="card">
                <div class="card-body">
                <div class="from-inline">
                    <label for="search">Search Record</label>
                    <input type="text"  id="search_patient"  class="form-control" placeholder="Search Patient" style="width: 300px;">
                    <div class="result">
                    </div>
                </div> 
                <br>
                <button type="button" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                    Add Patient
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form class="row g-3 needs-validation" action="add-patients.php" method="POST"  novalidate>
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" class="form-control" name="first_name" id="validationCustom01"  required>
                            <div class="invalid-feedback">
                                Input Field Required
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="last_name" id="validationCustom02" required>
                            <div class="invalid-feedback">
                            Input Field Required
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="validationCustom02" >
                            <div class="invalid-feedback">
                            Input Field Required
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Age</label>
                            <input type="text" class="form-control" name="age" id="validationCustom02" required>
                            <div class="invalid-feedback">
                            Input Field Required
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" id="validationCustom02" required>
                            <div class="invalid-feedback">
                            Input Field Required
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" name="mobile_number" placeholder="+63" pattern="[+][6]{1}[3]{1}[0-9]{10}" id="validationCustom02" required>
                            <div class="invalid-feedback">
                            Input Field Required use correct format
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">HMO</label>
                            <input type="text" class="form-control" name="hmo"  id="validationCustom02" required>
                            <div class="invalid-feedback">
                            Input Field Required
                            </div>
                        </div>
                        <div class="col-md-4 p-2">
                            <label for="validationCustom01" class="form-label">Gender:</label>
                                <div class="row g-2 border bg-white">
                                    <div class="col-5">
                                        
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" required>
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" required>
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Gender Required
                                    </div>
                                </div>
                        </div>
                        <div class="col-12">
                            <input  class="btn btn-primary" name="add_patient" type="submit" value="Register Patient">
                        </div>
                    </div>
                    </form>
                    </div>
                </div>
                </div>
                
            </div>
        </div>    
    </div>
    <div class="container">
        <div class="table-responsive">
            <div class="col-md-2"></div>
                <table class="table table-responsive table-striped table-hover caption-top" id="table_data">
                    <caption style="font-size: 20px;">List of Patients</caption>
                    <thead>
                        <tr>
                            <th scope="col">Patient ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Options</th>
                            <th></th>
                        </tr>
                    </thead>
                        <?php

                            $query = "SELECT * FROM patients LIMIT $start_from , $num_per_page";
                            $run = mysqli_query($conn,$query);

                            if(mysqli_fetch_assoc($run) > 0){
                                foreach($run as $row){
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row ['patient_id']?></td>
                                        <td><?php echo $row ['first_name']?></td>
                                        <td><?php echo $row ['last_name']?></td>
                                        <td><?php echo $row ['date_of_birth']?></td>
                                        <td><?php echo $row ['mobile_number']?></td>
                                        <td><?php echo $row ['email']?></td>
                                        <td>
                                            <a href="edit-patient.php?patient_id=<?php echo $row['patient_id']?>" class="btn btn-secondary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="delete-patient.php?patient_id=<?php echo $row ['patient_id']?>" class="btn btn-danger"> Delete </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                }
                            }
                        ?>  
                </table>

                <?php

                    $pr_query = "SELECT * FROM patients";
                    $pr_result = mysqli_query($conn,$pr_query);
                    $total_record = mysqli_num_rows($pr_result);
                   
                    $total_page = ceil($total_record / $num_per_page);

                    if($page > 1 ){
                        echo  "<a href='home.php?page=".($page-1)."' class='btn btn-danger'>Previous</a> ";
                    }

                    for($i=1;$i<$total_page;$i++){

                        echo  "<a href='home.php?page=".$i."' class='btn btn-primary'>$i</a> ";
                    }

                     if($i > $page ){
                        echo  "<a href='home.php?page=".($page+1)."' class='btn btn-danger'>Next</a> ";
                    }

                ?>

              
            </div>
        </div>
    </div>
           




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
(function () {
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>


<script>
    $(document).ready(function(){
       $("#search_patient").on("keyup",function(){
            var search = $(this).val();
            $.ajax({
                url: "search.php",
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

