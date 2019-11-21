<?php
// including the database connection file
require_once 'classes/Crud.php';
// including the Validation file
require 'classes/Validation.php';

$crud = new Crud();
$validation = new Validation();

if($_SERVER["REQUEST_METHOD"] == "POST") {

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
  $result = $crud->execute("INSERT INTO emp_details(emp_name,emp_email,emp_gender,emp_address) VALUES('$emp_name','$emp_email','$emp_gender','$emp_address')");
  header("Location:index.php");
  }
}
?>
