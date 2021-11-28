<?php

include('../connection.php');
session_start();
$patient_id = $_SESSION['patient_id'];
$patient_first_name = $_SESSION['first_name'];
$patient_last_name = $_SESSION['last_name'];
$patient_full_name = $patient_first_name . " ". $patient_last_name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>


<div class="container mt-5">
        <a href="home2.php" class="btn btn-primary mb-3">Back</a>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <h2>Current Appointment</h2>
                <thead>
                    <tr>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Time</th>
                        <th scope="col">Name of Doctor</th>
                        <th scope="col">Date Time Created</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $query = "SELECT * FROM appointments WHERE patient_id = '$patient_id' ";
                        $run = mysqli_query($conn,$query);

                        if(mysqli_num_rows($run) > 0){
                            foreach($run as $row ){
                                ?>
                                
                                    <tr>
                                        <td scope="col"><?php echo $row ['appointment_date']?></td>
                                        <td scope="col"><?php echo $row ['appointment_time']?></td>
                                        <td scope="col"><?php echo $row ['name_of_doctor']?></td>
                                        <td scope="col"><?php echo $row ['date_time_created']?></td>
                                        <td scope="col"><?php echo $row ['remarks']?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                Edit
                                            </button>
                                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Appointment Update</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="update-appointments.php" method="POST" class="row g-3 needs-validation" novalidate>
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Appointment Date</label>
                                                        <input type="text" class="form-control" name="appointment_date" id="datepicker" value="<?php echo $row ['appointment_date']?>" required>
                                                        <div class="invalid-tooltip">
                                                            Please Select Date
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 position-relative">
                                                        <label for="validationTooltip01" class="form-label">Time</label>
                                                        <select class="form-select" id="validationTooltip01" name="appointment_time" required>
                                                        <option value="<?php echo $row ['appointment_time']?>"><?php echo $row ['appointment_time']?></option>
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

                                                    <div class="col-md-6">
                                                        <label for="validationCustom04" class="form-label">Status</label>
                                                        <select class="form-select" id="validationCustom04" name="update_remarks" required>
                                                        <option selected disabled value="">Choose...</option>
                                                        <option value="Pending Appointment">Pending Appointment</option>
                                                        <option value="Cancelled Appointment">Cancel Appointment</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Remarks Update
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="hidden" name="patient_id" value="<?php echo $patient_id?>">
                                                    <input type="hidden" name="name_of_doctor" value="<?php echo $row ['name_of_doctor']?>">
                                                    <input type="hidden" name="account_id" value="<?php echo $row ['account_id']?>">
                                                    <input type="hidden" name="patient_full_name" value="<?php echo $patient_full_name?>">
                                                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                                                </div>
                                                </div>
                                                    </form>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <h2>History of Appointments</h2>
                <thead>
                    <tr>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Time</th>
                        <th scope="col">Name of Doctor</th>
                        <th scope="col">Date Time Created</th>
                        <th scope="col">Remarks</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query1 = "SELECT * FROM appointment_history WHERE patient_id = '$patient_id'";
                        $run1 = mysqli_query($conn,$query1);
                        if(mysqli_num_rows($run1) > 0){
                            foreach($run1 as $row1){
                                ?>
                                    <tr>
                                        <td><?php echo $row1 ['appointment_date']?></td>
                                        <td><?php echo $row1 ['appointment_time']?></td>
                                        <td><?php echo $row1 ['name_of_doctor']?></td>
                                        <td><?php echo $row1 ['date_time_created']?></td>
                                        <td><?php echo $row1 ['remarks']?></td>
                                        
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
