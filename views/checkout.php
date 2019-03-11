<?php

session_start();

require '../includes/database_connection.php';
require '../includes/functions.php';

//Load active user
$userId = $_SESSION['user_id'];
//Load userdata
$user = getUserById($pdo, $userId);
//Match user with products in database
$cart = getProductsForUser($pdo, $userId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidget Spinner Checkout</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">

</head>
<body>


<header>
<h1>FIDGETSPINNER STORE CHECKOUT</h1>
</header>



<div class="container">
    <main class="row main_content justify-content-center">
            

            <div class="card col-5">
            <h2>Your Order:</h2><br><br>
            
            </div>


            <?php
            $total_price = 0;
            foreach ($cart as $spinner) {
                $total_spinner_price = $spinner['quantity'] * $spinner['price'];
                $total_price += $total_spinner_price;
                ?>
                <div class="card col-5">
                    <img src="../<?= $spinner['image']; ?>" width=40%; />
                    <?= $spinner['quantity'] ?>st <p><?= $spinner['name']; ?>,</p> 
                    <?= $spinner['price'];?><p>kr/st,</p><br> 
                    Total:<?= $total_spinner_price;?>kr
                </div>
            <?php } ?>
            

            <div class="card col-8">

                <p>Total: <?= $total_price; ?>kr</p>
                
                
               <a href="order_sent.php" class="btn" type="button" >Send It!</a>
               <a href="../index.php" class="btn" type="button">Ajust Order</a>
            </div>



       </main>

</div>

<footer>

<div><i class="fas fa-copyright"></i>Fidget Spinners Worldwide</div>

</footer>

 
</body>
</html>