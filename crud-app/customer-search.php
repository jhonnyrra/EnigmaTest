<?php

require '../database.php';

$search = $_POST['search'];
if(!empty($search)) {
  $query = "SELECT * FROM customers WHERE firstname LIKE '$search%'";
  $stmt->execute();
  $results = $stmt->fetchAll();
  
  if(!$result) {
    die('Query Error' . mysqli_error($connection));
  }
  
  $json = array();
  foreach($results as $row) {
    $json["id"] = $row['id'];
    $json["firstname"] = $row['firstname'];
    $json["lastname"] = $row['lastname'];
    $json["phone"] = $row['phone'];
  }
  echo json_encode($json);
}

?>
