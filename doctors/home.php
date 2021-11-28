<?php

include('../connection.php');
session_start();

echo $_SESSION['email'];
echo $_SESSION['account_id'];


if(empty($_SESSION['email'])){
    echo "<script>window.location.href='login.php' </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/home.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</style>
<body id="main-body">
    <div class="content-wrapper">
        <div class="container-fluid p-5">
            
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <h3 id="hello-h3">Hello Dr. <?php echo $_SESSION['first_name']?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-container">
                                <div class="upper-container">
                                    <div class="image-container">
                                    <img src="../doctors/profile_picture/test.jpg" />
                                    </div>
                                </div>
                                <div class="lower-container">
                                    <div>
                                    <h3><?php echo $_SESSION['first_name']?></h3>
                                    <h4>Doctor</h4>
                                    </div>
                                    <div>
                                       <br> 
                                    <br>
                                    </div>
                                    <div>
                                    <a href="view-profile.php" class="btn">View profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-7">
              
                </div>
                <div class="col-md-2">
                <div class="navbar" id="side-nav">
                    <ul>
                        <li>
                            <a href="view-profile.php">View Profile</a>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>