<?php
// including the database connection file
include_once 'classes/Crud.php';

$crud = new Crud();
$id = $crud->escape_string($_GET['id']);

//selecting data associated with this particular id
$result = $crud->getData("SELECT * FROM emp_details WHERE emp_id=$id");

foreach ($result as $res) {
$emp_name = $res['emp_name'];
$emp_email = $res['emp_email'];
$emp_gender = $res['emp_gender'];
$emp_address = $res['emp_address'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    	<link rel="stylesheet"
    	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include main CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Include jQuery library -->
    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
          <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
          <!--[if lt IE 9]>
          <script src = "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
  </head>
  <body>
    <!-- Form used to add new entries of employee in database -->
    <h3 class="text-center">Read Employee Details</h3>
    <nav class="navbar navbar-default">
    <div class="navbar-header">
    <a href='index.php' title='Back to Main Page' data-toggle='tooltip'><button class="btn btn-primary"><i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>
    Back</button></a>
    </div>
    </nav>
<form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"  class="form-horizontal alert alert-warning" name="empList" id="empForm">
<div class="form-group">
<label for="Name">Employee Name:</label>
<input type="text" value="<?php echo $emp_name;?>" name="emp_name" disabled class="form-control" placeholder="Enter Employee Name"/>
</div>
<div class="form-group">
<label for="Email">Email Address:</label>
<input type="email" value="<?php echo $emp_email;?>" name="emp_email" disabled class="form-control" placeholder="Enter Employee Email Address"/>
</div>
<div class="form-group">
<label for="Gender">Gender:</label>
<label for="" class="radio-inline gender">
<input type="radio" name="emp_gender" disabled value="male" <?php echo ($emp_gender == 'male')?'checked':''?>>Male
</label>
<label for="" class="radio-inline gender">
<input type="radio" name="emp_gender" disabled value="female" <?php echo ($emp_gender == 'female')?'checked':''?>>Female
</label>
</div>
<div class="form-group">
<label for="Address">Address:</label>
<input type="text" value="<?php echo $emp_address;?>" name="emp_address" disabled class="form-control" placeholder="Enter Employee Address"/>
</div>
<!-- <div class="form-group">
<p class="text-danger">Address field is Empty!</p>
</div> -->
</form>
  </body>
</html>
