<?php
// including the database connection file
include_once 'classes/Crud.php';
// including the Validation file
require 'classes/Validation.php';

$crud = new Crud();
$validation = new Validation();
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $crud->escape_string($_GET['id']);
    // Get hidden input value
    $emp_name = $crud->escape_string($_POST['emp_name']);
    $emp_email = $crud->escape_string($_POST['emp_email']);
    $emp_gender = $crud->escape_string($_POST['emp_gender']);
    $emp_address = $crud->escape_string($_POST['emp_address']);

    $msg = $validation->check_empty($_POST, array('emp_name', 'emp_email', 'emp_gender', 'emp_address'));
    //$sanitize_data = is_input_valid($_POST, array('emp_name', 'emp_email', 'emp_gender', 'emp_address'));
    $check_name = $validation->is_name_valid($_POST['emp_name']);
    $check_email = $validation->is_email_valid($_POST['emp_email']);

    if ($msg != null) {
      echo $msg;
    } elseif (!$check_name) {
      echo 'Enter the Valid Employee Name';
    } elseif (!$check_email) {
      echo "Enter valid Email";
    } else {
    $emp_name = htmlspecialchars(stripslashes(trim($emp_name)));
    $emp_email = htmlspecialchars(stripslashes(trim($emp_email)));
    $emp_gender = htmlspecialchars(stripslashes(trim($emp_gender)));
    $emp_address = htmlspecialchars(stripslashes(trim($emp_address)));
    $result = $crud->execute("UPDATE emp_details SET emp_name='$emp_name',emp_email='$emp_email',emp_gender='$emp_gender',emp_address='$emp_address' WHERE emp_id=$id");
    header("Location:index.php");
    }
  } else {
//getting id from url
// Check existence of id parameter before processing further
    if(isset($_GET["id"])) {
          $id = $crud->escape_string($_GET['id']);

      //selecting data associated with this particular id
      $result = $crud->getData("SELECT * FROM emp_details WHERE emp_id=$id");

      foreach ($result as $res) {
          $emp_name = $res['emp_name'];
          $emp_email = $res['emp_email'];
          $emp_gender = $res['emp_gender'];
          $emp_address = $res['emp_address'];
        }
      }
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
    <h3 class="text-center">Edit Employee Details</h3>
    <nav class="navbar navbar-default">
    <div class="navbar-header">
    <a href='index.php' title='Back to Main Page' data-toggle='tooltip'><button class="btn btn-primary"><i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>
    Back</button></a>
    </div>
    </nav>
<form method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"  class="form-horizontal alert alert-warning" name="empList" id="empForm">
<div class="form-group">
<label for="Name">Employee Name:</label>
<input type="text" value="<?php echo $emp_name;?>" name="emp_name" class="form-control" placeholder="Enter Employee Name"/>
</div>
<div class="form-group">
<label for="Email">Email Address:</label>
<input type="email" value="<?php echo $emp_email;?>" name="emp_email" class="form-control" placeholder="Enter Employee Email Address"/>
</div>
<div class="form-group">
<label for="Gender">Gender:</label>
<label for="" class="radio-inline gender">
<input type="radio" name="emp_gender" value="male" <?php echo ($emp_gender == 'male')?'checked':''?>>Male
</label>
<label for="" class="radio-inline gender">
<input type="radio" name="emp_gender" value="female" <?php echo ($emp_gender == 'female')?'checked':''?>>Female
</label>
</div>
<div class="form-group">
<label for="Address">Address:</label>
<input type="text" value="<?php echo $emp_address;?>" name="emp_address" class="form-control" placeholder="Enter Employee Address"/>
</div>
<!-- <div class="form-group">
<p class="text-danger">Address field is Empty!</p>
</div> -->
<div class="form-group">
<button type="submit" name="update" class="btn btn-warning">Edit Into Database</button>
</div>
</form>
  </body>
</html>
