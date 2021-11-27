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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login-doctors.css">
    <title>Document</title>
</head>
<body>

<div class="container">
    <form action="" method="POST" class="row g-3 needs-validation" novalidate>
        <h1>Welcome Doctors!</h1>

        <div class="col-md-6">
            <label for="validationCustomUsername" class="form-label">Email</label>
            <div class="input-group has-validation">
            <input type="text" name="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
                Please Input Email Address.
            </div>
            </div>
        </div>
    <new>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Account Id</label>
            <input type="text" class="form-control" id="validationCustom02" name="account_id" required>
            <div class="invalid-feedback">
                Please Input Account Id.
            </div>
        </div>
    </new>

        <div>
            <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr">
        </div><br>

        <div class="col-12">
            <input class="btn btn-primary" type="submit" name="login" value="Login">
        </div>

    </div>

    </form>
</div>
    <a href="registration.php">No Account? Sign up</a> <br>
    <a href="forgot_account_id.php">Forgot Account Id</a>
</body>
</html>



<?php

if(isset($_POST['login']) && $_POST['g-recaptcha-response'] != ""){

    $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
    $response_data = json_decode($verify_response);

    if($response_data->success){
        $email = $_POST['email'];
        $account_id = $_POST['account_id'];   

        $query_users = "SELECT * FROM users WHERE email ='$email' AND account_id = '$account_id'";
        $run_users = mysqli_query($conn,$query_users);

        if($run_users){
            if(mysqli_num_rows($run_users) == 1){
                $result = mysqli_fetch_assoc($run_users);
                if($result['email_status'] == 1){
                    if($result['doctor_or_secretary'] == 'secretary'){
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
}

?>

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
