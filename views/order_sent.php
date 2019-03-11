<?php
session_start();

$userId = $_SESSION['user_id'];

require '../includes/database_connection.php';
require '../includes/functions.php';

removeCartForUser($pdo, $userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="../css/style.css">

<title>Fidget spinner store</title>

</head>


<body>

<header>

<h1>FIDGETSPINNER STORE</h1>

</header>


<div class="container-fluid ">

  <main class="row justify-content-center">

   <div class="card col-5">
            
        <h2>Thank you for your order!</h2><br><br>
        <a href="../index.php" type="button" class="btn">Shop more</a>
            
   </div>
             
  </main>


</div>

<footer>

<div><i class="fas fa-copyright"></i>Fidget spinners worldwide</div>

</footer>
 
</body>
</html>