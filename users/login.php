<?php
include('../connection.php');
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src= "https://kit.fontawesome.com/b99e675b6e.js" ></script>
    
</head>
<body>

<div class="container p-4">
    <form action="login.php" method="POST" class="row g-2 needs-validation" novalidate>
        <h3>Welcome Secretary!</h3>  
            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Email</label>
                <input type="email" class="form-control" id="validationCustom01" name="email" required>
                <div class="invalid-feedback">
                    Require Field
                </div>
            </div>

            <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Account Id</label>
                <input type="text" class="form-control" id="validationCustom01" name="account_id" required>
                <div class="invalid-feedback">
                    Require Field
                </div>
            </div>

           
            <br>
            <div class="col-md-4">
                <input class="btn btn-primary" name="login" type="submit" value="Log in">
            </div>
    
        <a href="reg-users.php">No account? Sign Up</a> <br>
        <!-----wala pa tong function--->
        <a href="forgot_account_id.php">Forgotten account id?</a> <br>
        <a href="../doctors/login.php">Doctor's Portal</a> <br>
        <a href="../login-patient.php">Patient's Portal</a>
    </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $account_id = $_POST['account_id'];

    $query_users = "SELECT * FROM users WHERE email ='$email' AND account_id = '$account_id'";
    $run_users = mysqli_query($conn,$query_users);

    if($run_users){
        if(mysqli_num_rows($run_users) == 1){
            $result = mysqli_fetch_assoc($run_users);
            if($result['email_status'] == 1){
                if($result['doctor_or_secretary'] == 'doctor'){
                    echo "Access Denied";
                    exit();
                }
                    if($_POST['account_id'] == $result['account_id']){
                        $_SESSION['email'] = $result['email'];
                        $_SESSION['account_id'] = $result['account_id'];
                        $_SESSION['first_name'] =$result['first_name'];
                        $_SESSION['last_name'] = $result['last_name'];
                        header("Location: home.php");
                    }else{
                        echo "Account id / Email Error :" .$conn->error;
                    }
                }else{
                    echo "please verify your email address" . $conn->error;
                }
            }else{
            echo "account not found" . $conn->error;
        }
    }
}
?>
<script>

(function () {
'use strict'
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