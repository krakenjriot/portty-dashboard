<!--
Used basic html and bootstrap skeleton from the below link for style purpose which contains bootstrap.css,bootstrap.js,jquery.js
https://www.w3schools.com/bootstrap/bootstrap_get_started.asp
Used bootstrap form elements from below link.
https://www.w3schools.com/bootstrap/bootstrap_forms.asp-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Live Demo: Bootstrap simple datepicker example</title>
        <meta content='Live Demo: Bootstrap simple datepicker example' name='description' />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Custom fonts for this template-->
<link href="{{URL::asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Datepicker stylesheet -->
<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<!-- Datepicker script -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<!--  Stylesheet -->
<link href="{{URL::asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
    <body>       
        <div class="container" style="max-width:800px;margin:0 auto;margin-top:50px;margin-bottom: 50px;">             
            <h1 style="margin-bottom:50px;font-size:28px;">Live Demo: Bootstrap simple datepicker example</h1>  
            <div class="row">
<!-- Start of Datepicker -->
<div class="input-group form-group">
    <div class='col-sm-6'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- End of DatePicker -->
  

<!-- DatePicker Script -->
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker();
    });
</script>
<!-- End of Datepicker Script -->            
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>      	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>      	
        <script>
            $(document).ready(function () {
                $('#example1').datepicker({
                    autoclose: true,
                    format: "dd/mm/yyyy"
                });
            });
        </script>       
    </body>
</html>