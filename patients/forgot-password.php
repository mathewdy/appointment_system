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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <a href="home2.php">Cancel</a>
        <form class="row g-2 needs-validation" method="POST" action="" novalidate>
            <center>
                <div class="col-md-5">
                    <label for="validationCustom01" class="form-label">Please Enter your email address</label>
                    <input type="email" class="form-control" name="email" id="validationCustom01" value="" required>
                    <div class="invalid-feedback">
                        Input Required
                    </div><br>
                </div>
            <div class="col-12">
                <input class="btn btn-primary" type="submit" name="forgot_password" value="Enter">
            </div>
            </center>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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

</body>
</html>


<?php


if(isset($_POST['forgot_password'])){
    $email = $_POST['email'];

    $_SESSION['email'] = $email;
    header("Location: confirm-password");
}

?>