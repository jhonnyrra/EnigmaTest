<?php

  require '../database.php';
  
  $records = $conn->prepare('SELECT * FROM customers');
  $records->execute();
  $results = $records->fetchAll();

  $json = array();
 
  foreach($results as $row) {
    $json[] = array(
      'firstname' => $row['firstname'],
      'lastname' => $row['lastname'],
      'phone' => $row['phone'],
      'id' => $row['id']
    );
  }
  //print('Hey there GG! '. $json);
  echo json_encode($json);
?>
