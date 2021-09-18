<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script>
$(function() {
    $( "#datepicker" ).datepicker(
    {
        beforeShowDay: function(d) {
            var sunday = d.get_class_vars()
            var day = d.getDay()
            return [(day != 2)];
        }
    });
  });
  </script>
</head>
<body>
    <label for="">Select Date</label>
    <?php 

    ?>
<input type="text" id="datepicker" min="2021-09-03">

</body>
</html>

<?php
// so dito via #id na lalabas, diba ifetech ko yung data sa database. value="<?php echo $row ['schedule']
//&& day != 3 && day != 2 && day != 4 && day != 6 //
// var day = d.getDay();

?>