<?php
require_once 'DBConfig.php';

class Crud extends DBConfig {
  public function __construct() {
    parent::__construct();
  }

  public function getData($query) {
    $result = $this->connection->query($query);
    if ($result == false) {
      return false;
    }
    $rows = array();

    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }

  public function execute($query) {
    $result = $this->connection->query($query);

    if ($result == false) {
      echo 'Error: cannot execute the command';
      return false;
    } else {
      return true;
    }
  }

  public function delete($id) {
    $query = "DELETE FROM emp_details WHERE emp_id = $id";

    $result = $this->connection->query($query);
    if ($result == false) {
      echo 'Error: cannot delete id ' .$id . 'from table ';
      return false;
    }
    $sql = "SET @num := 0;";
    $sql .= "UPDATE emp_details SET emp_id = @num := (@num+1);";
    echo $sql .= "ALTER TABLE emp_details AUTO_INCREMENT =1";
    $result = $this->connection->multi_query($sql);
    return true;
  }

  public function escape_string($value) {
    return $this->connection->real_escape_string($value);
  }
}
?>
