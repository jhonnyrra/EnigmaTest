<?php
  session_start();

  require '../database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Crud Customers Enigma</title>
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
  </head>
  <body>

    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand row align-items-start order-1 href="#">Crud Customers Enigma</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="col order-5" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <form class="form-inline my-2 my-lg-0">
            <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          </form>
      </div>

      
      <div class="col order-7">
        <?php if(!empty($user)): ?>
          <br> Welcome. <?= $user['email']; ?>
          <br>You are Successfully Logged In
          <a href="../logout.php">Logout</a>
        <?php else: ?>
          <h1>Please Login or SignUp</h1>
          <a href="../login.php">Login</a> or
          <a href="../signup.php">SignUp</a>
        <?php endif; ?>
        
      </div>
    </nav>

    <div class="container">
      <div class="row p-4">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <!-- FORM TO ADD CUSTOMERS -->
              <form id="customer-form">
                <div class="form-group">
                  <input type="text" id="firstname" placeholder="First Name" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" id="lastname" placeholder="Last Name" class="form-control">
                </div>
                <div class="form-group">
                  <input type="text" id="phone" class="form-control" placeholder="Phone Number">
                  <input type="hidden" id="customerId">
                </div>
                <button type="submit" class="btn btn-primary btn-block text-center">
                  Save Customer
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- TABLE  -->
        <div class="col-md-7">
          <div class="card my-4" id="customer-result">
            <div class="card-body">
              <!-- SEARCH -->
              <ul id="container"></ul>
            </div>
          </div>

          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <td>Id</td>
                <td>Full Name</td>
                <td>Phone</td>
              </tr>
            </thead>
            <tbody id="customers"></tbody>
          </table>
        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="app.js"></script>
  </body>

</html>
