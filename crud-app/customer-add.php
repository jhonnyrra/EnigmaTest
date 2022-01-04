<?php

  require '../database.php';

  $message = '';

  if(isset($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['phone'])) {
    $query = "INSERT INTO customers(firstname, lastname, phone) VALUES (:firstname, :lastname, :phone)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':firstname', $_POST['firstname']);
    $stmt->bindParam(':lastname', $_POST['lastname']);
    $stmt->bindParam(':phone', $_POST['phone']);

    if ($stmt->execute()) {
      $message = 'Successfully created new customer';
    } else {
      $message = 'Sorry there must have been an issue creating your customer.';
    } 

  }

?>
