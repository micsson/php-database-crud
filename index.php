<?php

session_start();

//Load database
require 'includes/database_connection.php';
//Access functions
require 'includes/functions.php';

//Display products only if user is logged in
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  if (!empty($userId)) {
    $stored_cart = getProductsForUser($pdo, $userId);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="css/style.css">

<title>Fidget spinner store</title>

</head>


<body>

<header>

<h1>FIDGETSPINNER STORE</h1>

<h2>Hello! <?= $_SESSION["username"] ?? 'Please register and login to shop=)'?></h2>

</header>


<div class="container-fluid ">
  <main class="row justify-content-center">
    
    <?php 
    //Display registration and login form if user is not registered and logged in
    if (empty($userId)) {   ?>
        <div class="card col-5">
              <h2>Register</h2>
                  <form action="views/register.php" method="POST">
                    <label for="register_username">Username</label><br>
                    <input class="form-control"  type="text" name="username" placeholder="Username" id="register_username" required><br>
                    <label for="register_password">Password</label><br>
                    <input class="form-control"  type="password" name="password" placeholder="Password" id="register_password" required><br>
                    <label for="fullname">Full Name</label><br>
                    <input class="form-control"  type="text" name="fullname" id="fullname" placeholder="First and last name" value="<?= $_SESSION['fullname'] ?? ''; ?>" required><br>
                    <label for="adress">Adress</label><br>
                    <input class="form-control"  type="adress" name="adress" id="adress" placeholder="Deliveryadress" value="<?= $_SESSION['adress'] ?? ''; ?>" required><br>
                    <label for="phone">Phone</label><br>
                    <input class="form-control"  type="phone" name="phone" id="phone" placeholder="Phone." value="<?= $_SESSION['phone'] ?? ''; ?>" required><br>
                    <label for="email">Email</label><br>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email." value="<?= $_SESSION['email'] ?? ''; ?>" required><br>
                    <input class="btn btn-primary" type="submit" value="Register">
                  </form>
        </div>
        
        <div class="card col-5">
              <h2>Login</h2>
                    <form action="views/login.php" method="POST">
                      <label for="login_username">Username</label><br>
                      <input class="form-control"  type="text" name="username" placeholder="Username" id="login_username"><br>
                      <label for="login_password">Password</label><br>
                      <input class="form-control"  type="password" name="password" placeholder="Password" id="login_password"><br>
                      <input class="btn btn-primary" type="submit" value="Login">
                      
                    </form>
        </div>
<?php } else { ?>
              <?php
              //Handle so users cannot type in minus figures and convert special characters to HTML entities 
              if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($_GET['error']) . '</div>'; 
              }

              $all_spinners = getAllSpinners($pdo);

              foreach($all_spinners as $allSpinner => $spinner): ?>
                  <div class="card col-5" >
                      <img src="<?= $spinner['image']; ?>" width=40%; />
                      <p><?= $spinner['name']; ?></p>
                      <p><?= $spinner['color']; ?></p>
                      <p><?= $spinner['price']; ?>Kr/st</p>
                      <form action="views/cart.php" method="POST">
                      <input type="number" class="form-control" value="<?= $stored_cart[$spinner['name']]['quantity'] ?? 0; ?>" name="quantity">
                      <input type="hidden" name="product_id" value=<?= $spinner['id']; ?> />
                      <input class="btn btn-primary" type="submit" value ="Update cart">
                    </form>
                  </div>
              <?php endforeach;  ?>

              

              <div class="card col-5">
                  <form action="views/checkout.php" method="POST" id="checkout">
                  <input class="btn btn-success" type="submit" value ="Checkout"><br>
                  </form>
              </div>


              <div class="card col-5">
                  <form action="views/destroy.php" method="POST">
                  <input class="btn btn-danger" type="submit" value="Logout">
              </form>
              </div>
    <?php } ?>
             
  </main>


</div>

<footer>

<div><i class="fas fa-copyright"></i>Fidget spinners worldwide</div>

</footer>
 
</body>
</html>