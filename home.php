<?php
include('connection.php');
session_start();
if(empty($_SESSION['email'])){
  echo "<script> window.location.href='login-patient.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book Appointment</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="assets/css/bootstrap.rtl.min.css" rel="stylesheet">
      <link href="assets/css/dashboard.rtl.css" rel="stylesheet">
  </head>
      <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  <style>

body{
    background:linear-gradient(135deg, #0e3c49, #732264);
}
.my_label{
    color: white;
}
.my_select_btn{
    width: 100%;
}
.my_form{

padding: 5px 5px;
}
.my-bg{
    background:#D8D7E7;
    width: 15%;
}
.my-logout{
   background-color: transparent; border: none;

}

.my-data{
padding: 30px 30px;
background-color: #f7f7f7;
margin-top: 10%;
height: 90%;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
border-radius: 25px 25px;
}
.my-left-m{
  margin-left: 10%;
}
.my-main-bt{
  margin-bottom: 10%;
}
.container-fluid .row ul li{
  padding: 30px 0;
  padding-top: 1em;
  padding-left: 5px;
}

.container-fluid ul{
  padding-left: 10px;
  padding-right: 10px;
}

</style>

<body>

<div class="container-fluid">
  <div class="row">

    <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block my-bg sidebar collapse">
      <div class="position-sticky pt-3">

        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="home.php" style="font-size: 21px; border-bottom: 1px solid gray;">Home</a>
          </li>
          <li class="nav-item">
           <a class="nav-link" href="appointments.php" style="font-size: 21px; border-bottom: 1px solid gray;">Appointments</a>
          </li>
          <li class="nav-item">
           <a class="nav-link" href="logout.php" style="font-size: 21px; border-bottom: 1px solid gray;">Logout</a>
          </li>
      </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-3 col-lg-5">
      <div class="d-flex pt-4 my-left-m">
            <img rel="icon" src="assets/logo.png" width="150">&nbsp 

      </div>
    </main>

     <center><h2 style="color: white; margin-right: 20%;">Book an Appointment</h2></center>

  </div>
</div>


<div class="container">
<br>

    <form action="#" method="POST" class="col-4">
       <div class="input-group mb-3">
        <select name="specialization" id="" class="form-select">
          <option value="">Specialization</option>
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
            </select>&nbsp&nbsp
  <input type="submit" name="select" value="Select" class="btn btn-primary">
  </form>
</div>
     
    
    <br>

  <main style="position: relative;" class="my-main-bt">

<?php


if(isset($_POST['select'])){
   
// unfinished 
  $specialization = $_POST['specialization'];
  // mali to
    $select_doctors_Details = "SELECT users.account_id, users.first_name,users.last_name,users.gender,users.mobile_number,doctors_details.specialization,doctors_details.internship,doctors_details.residency,
    doctors_details.hmo,doctors_details.doc_picture
    FROM users
    LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
    WHERE doctors_details.specialization = '$specialization'";
    $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);

    if($run_doctors_Details){
        ?>
            <div class="row">
        <?php
        
        if(mysqli_num_rows($run_doctors_Details) > 0)
        foreach($run_doctors_Details as $row){
                ?>

                    <div class="col-3">
                <div class="my-data">

                  <img src="<?php echo "users/doc_picture/" .$row['doc_picture']; ?>" alt="Doc Image" width="100" height="100"><br><br>
                  <a href="doctors-profile.php?account_id=<?php echo $row ['account_id']?>" style="text-decoration: none;">View Profile</a><br><br>
                   <label><b>Doctor:</b>&nbsp<?php echo $row ['first_name'] . $row ['last_name']?></label><br>
                            <label><b>Specialization: </b>&nbsp<?php echo $row ['specialization']?></label><br>
                            <label><b>HMO: </b><?php echo $row ['hmo']?></label><br>
                </div>
                </div>  
  
                <?php
        }else{
           ?>

              <style>
                p{
                  color: white;
                  font-size: 30px;
                }
              </style>

              <p><?php echo "No Found" . $conn->error ?></p>

          <?php
        }
        ?>
</div>

        <?php
    }
}


?>
</main>
</div>
</body>

    <!--kulang ako ng side bar-->




</html>