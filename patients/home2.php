<?php
include('../connection.php');
session_start();
if(empty($_SESSION['email'])){
  echo "<script> window.location.href='login-patient.php'</script>";
}


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
  <a href="home2.php" >Home</a>
  <a href="appointments.php" >Appointments</a>
  <a href="logout.php">Logout</a>
    
</div>

<div class="container py-5">
<h2>Our Doctors</h2>
  <div class="row mt-4">
    <div class="from-inline">
        <div class="card">
            <div class="card-body">
                <form action="search-doctors.php" method="POST" class="row g-3">
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label"></label>
                        <input type="text"  name="name_of_doctor"  class="form-control mt-2" placeholder="Search Doctor" style="width: 300px;">
                    </div>
                    <br>
                        <div class="col-md-3">
                            <label for="validationCustom04" class="form-label">Specialization</label>
                            <select name="specialization" class="form-select" id="">
                            <option value="" selected disabled>-Select-</option>
                            <option value="Allergy and immunology">Allergy and immunology</option>
                            <option value="Anesthesiology">Anesthesiology</option>
                            <option value="Dermatology">Dermatology</option>
                            <option value="Diagnostic radiology">Diagnostic radiology</option>
                            <option value="Emergency medicine">Emergency medicine</option>
                            <option value="Family medicine">Family medicine</option>
                            <option value="Internal medicine">Internal medicine</option>
                            <option value="Medical genetics">Medical genetics</option>
                            <option value="Neurology">Neurology</option>
                            <option value="Nuclear medicine">Nuclear medicine</option>
                            <option value="Obstetrics and gynecology">Obstetrics and gynecology</option>
                            <option value="Ophthalmology">Ophthalmology</option>
                            <option value="Pathology">Pathology</option>
                            <option value="Pediatrics">Pediatrics</option>
                            <option value="Physical medicine and rehabilitation">Physical medicine and rehabilitation</option>
                            <option value="Preventive medicine">Preventive medicine</option>
                            <option value="Psychiatry">Psychiatry</option>
                            <option value="Radiation oncology">Radiation oncology</option>
                            <option value="Surgery">Surgery</option>
                            <option value="Urology">Urology</option>
                            </select> <br>
                        </div>
                        <div class="col-12" >
                            <input class="btn btn-primary" type="submit" name="search" value="Search" >
                        </div>
                </form>
            </div>
        </div>
    </div> 

<?php

    $query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
    WHERE users.doctor_or_secretary = 'doctor' LIMIT $start_from , $num_per_page";
    $run = mysqli_query($conn,$query);

    if(mysqli_fetch_assoc($run) > 0){
        foreach($run as $row){

        ?>
                <div class="col-md-4 mt-3 mb-2" >
                    <div class="card" style="width: 18rem;">
                    <img src="<?php echo "../users/doc_picture/" . $row ['doc_picture']?>" width="255px" height="200px" alt="...">
                        <div class="cardbody">
                        <h2 class="card-title"><?php echo $row ['specialization']?></h2>
                        <h3 class="card-text"><?php echo $row ['first_name']?> <?php echo $row ['last_name']?></h3> <br>
                            <center>
                                <a href="view-profile-doctor.php?account_id=<?php echo $row ['account_id']?>" class="btn btn-success" >View Profile</a>
                            </center>
                        </div>
                    </div>
                </div>


        <?php
    }
}else{
    echo '<div class="text-danger">'. '<h3>'  . "No data" . '</h3>' .'</div>' . $conn->error;
}


?>


<div class="container py-5">

<?php

$pr_query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
WHERE users.doctor_or_secretary = 'doctor'";
$pr_result = mysqli_query($conn,$pr_query);
$total_record = mysqli_num_rows($pr_result);

$total_page = ceil($total_record / $num_per_page);

if($page > 1 ){
    echo  "<a href='home2.php?page=".($page-1)."' class='btn btn-danger'>Previous</a> ";
}

for($i=1;$i<$total_page;$i++){

    echo  "<a href='home2.php?page=".$i."' class='btn btn-primary'>$i</a> ";
}

    if($i > $page ){
    echo  "<a href='home2.php?page=".($page+1)."' class='btn btn-danger'>Next</a> ";
}

?>

  </div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>