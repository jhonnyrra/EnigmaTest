<?php

require '../database.php';

if(isset($_POST['id'])) {

  $query = "SELECT * FROM customers WHERE id = :id";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id', $_POST['id']);
  $stmt->execute();
  $results = $stmt->fetchAll();
  if(!$results) {
    die('Query Failed'. $results);
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
