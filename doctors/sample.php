
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script>
    function myfunc(){
    var a = document.getElementById("mobile_num").value;
  
    if((a.charAt(0)!= '+' )){
    document.getElementById("errors").innerHTML = "start with + ";
    return false;
    }
    if(a.charAt(1)!= '6'){
      document.getElementById("errors").innerHTML = " use international phone format";
    return false;
    }
    if(a.charAt(2)!= '3'){
      document.getElementById("errors").innerHTML = "use international phone format ";
    return false;
    }
    if(isNaN(a)){
      document.getElementById("errors").innerHTML = "numbers only";
      return false;
    }
    if(a.length > 13){
      document.getElementById("errors").innerHTML = "13 numbers only";
      return false;
    }
    if(a.length < 13){
      document.getElementById("errors").innerHTML = "13 numbers only";
      return false;
    }

    else{
    document.getElementById("errors").innerHTML = "nice";
    }

  }
</script>
<form action="" method="POST" onsubmit="return myfunc()">

<label for="">Mobile Number</label>
<input type="text" name="mobile_number" id="mobile_num"> <br>
<div id="errors">
</div>
<div class="col-12">
        <input class="btn btn-primary" type="submit" value="Update" name="update">
</div>
                

</form>

</body>
</html>

<?php

if(isset($_POST['update'])){


    $mb = $_POST['mobile_number'];

    echo $mb;
}

?>

