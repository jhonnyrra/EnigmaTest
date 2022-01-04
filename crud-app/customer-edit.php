<?php

require '../database.php';

if(isset($_POST['id'])) {
  $first_name = $_POST['firstname']; 
  $last_name = $_POST['lastname'];
  $phone = $_POST['phone'];
  $id = $_POST['id'];
  $query = "UPDATE customers SET firstname = '$first_name', lastname = '$last_name', phone = '$phone' WHERE id = $id";
  $stmt = $conn->prepare($query); 

  if ($stmt->execute()) {
    $message = 'Customers Update Successfully';
  } else {
    $message = 'Sorry there must have been an issue updating your customer.';
  }  

}

?>
