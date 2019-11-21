<?php
class Validation {
  public function check_empty($data, $field) {
    $msg = null;
    foreach ($field as $value) {
      if (empty($data[$value])) {
        $msg .= "$value field empty <br>";
      }
    }
    return $msg;
  }

  public function is_name_valid($name) {
    if(filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
      return true;
    }
    return false;
  }

  public function is_email_valid($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    }
    return false;
  }

  // public function is_input_valid($data, $field) {
  //   $data = trim($data);
  //   $data = stripslashes($data);
  //   $data = htmlspecialchars($data);
  //   return $data;
  //   $sanitize_data = null;
  //   foreach ($field as $value) {
  //     if (trim($sanitize_data[$value]) && stripslashes($sanitize_data[$value]) && htmlspecialchars($sanitize_data[$value])) {
  //       $sanitize_data .= "$value field empty <br>";
  //     }
  //   }
  //   return $data;
  // }
}
?>
