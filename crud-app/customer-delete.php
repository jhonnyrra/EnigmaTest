<?php

require '../database.php';

if(isset($_POST['id'])) {
  $id = $_POST['id'];
  $query = "DELETE FROM customers WHERE id = $id";
  $stmt = $conn->prepare($query);

  if ($stmt->execute()) {
    $message = 'Customers Deleted Successfully';
  } else {
    $message = 'Sorry there must have been an issue deleting your customer.';
  }    

}

?>