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
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    
<div class="container">
    <div class="card">
        <div class="card-body">
            <a href="set-appointment.php">Cancel</a>

        <?php

            if(isset($_GET['patient_id'])){
                $patient_id = $_GET['patient_id'];
                $query = "SELECT * FROM patients WHERE patient_id = '$patient_id'";
                $run = mysqli_query($conn,$query);

                if(mysqli_num_rows($run) > 0){
                    foreach($run as $row){
                        ?>

                        <form class="row g-3 needs-validation" method="POST" action="select-doctor.php" novalidate>
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="patient_first_name" id="validationTooltip01" value="<?php echo $row ['first_name']?>" required>
                                <div class="invalid-tooltip">
                                    Input Details
                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="patient_last_name" id="validationTooltip01" value="<?php echo $row ['last_name']?>" required>
                                <div class="invalid-tooltip">
                                    Input Details
                                </div>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip01" class="form-label">Time</label>
                                <select class="form-select" id="validationTooltip01" name="appointment_time" required>
                                <option selected disabled value="">Appointment Time</option>
                                <option value="09:00:00 AM">09:00 AM</option>
                                <option value="09:30:00 AM">09:30 AM</option>
                                <option value="10:00:00 AM">10:00 AM</option>
                                <option value="10:30:00 AM">10:30 AM</option>
                                <option value="11:00:00 AM">11:00 AM</option>
                                <option value="11:30:00 AM">11:30 AM</option>
                                <option value="12:00:00 PM">12:00 PM</option>
                                <option value="12:30:00 PM">12:30 PM</option>
                                <option value="01:00:00 PM">01:00 PM</option>
                                <option value="01:30:00 PM">01:30 PM</option>
                                <option value="02:00:00 PM">02:00 PM</option>
                                <option value="02:30:00 PM">02:30 PM</option>
                                <option value="03:00:00 PM">03:00 PM</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Please Select Time
                                </div>
                            </div>
                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip01" class="form-label">Date</label>
                                <input type="text"   class="form-control" name="appointment_date" id="datepicker" required>
                                <div class="invalid-tooltip">
                                    Please Select Date
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="submit"  class="btn btn-primary" name="next" value="Next">
                                <input type="hidden" name="patient_id" value="<?php echo $row['patient_id']?>">
                                <input type="hidden" name="mobile_number" value="<?php echo $row ['mobile_number']?>">
                            </div>
                        </form>
                        <?php
                    }
                }
            }
        ?>
        
        </div>
    </div>
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

 <script>     
    $(function() {
        var date_today = new Date();
        $( "#datepicker" ).datepicker({
            minDate: date_today,
            minDate: 4,
            beforeShowDay: function(d) {
                var day = d.getDay()
                return [(day != 0 && day != 1)];
              
            }
        });
    });
</script> 

</body>
</html>

