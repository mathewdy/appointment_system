<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h3>auto save data</h3>
    <div class="form-group">
        <input type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
        <input type="text" name="full_name" id="full_name" class="form-control">
    </div>
   <div class="form-group">
       <input type="text" name="id" value="1" class="form-control" id="id">
       
   </div> 
    
   <div id="auto_save"></div>
</body>
</html>

<script>
    $(document).ready(function(){
        function auto_save(){
            var username = $('#username').val();
            var full_name = $('#full_name').val();
            var id = $('#id').val();

            if(username != '' && full_name != '')
            {
                $.ajax({
                    url: "save.php",
                    method: "POST",
                    data: {postUsername: username, postFullName: full_name , Id:id},
                    dataType: "text",
                    success: function(data){
                        if(data != ''){
                            $('#id').val(data);
                        }
                        $('#auto_save').text("Save");
                        setInterval(function(){
                            $('#auto_save').text('');
                        }, 2000);
                    }
                    
                });
            }
        }
        setInterval(function(){
            auto_save();
        }, 10000);
    });
</script>


