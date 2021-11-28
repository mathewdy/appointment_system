<?php

session_start();
include('../connection.php');


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
<div class="container">
    <form action="validate.php" method="POST" class="needs-validation" novalidate>
    

        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Email</label>
            <input type="text" class="form-control" id="validationCustom01"  name="code" required>
            <div class="invalid-feedback">
                Input Required
            </div>
        </div>

        <div class="col-12">
            <input class="btn btn-primary" type="submit" name="confirm" value="Confirm">
        </div>
    
    </form>
</div>
</body>
</html>

<?php

if(isset($_POST['confirm'])){

$code = $_POST['code'];

$query= "UPDATE users SET account_id = '$code' WHERE email='$email'";
$run = mysqli_query($conn,$query);

if($run){
   echo "<script>alert('Account Id Updated') </script>";
   echo "<script>window.location.href='login.php'  </script>";
    
}else{
    echo "error" . $conn->error;
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