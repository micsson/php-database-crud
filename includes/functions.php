<?php

//Loads active products from database
function getAllSpinners($pdo) {
    $spinners = [];
    $database_spinners = $pdo->query('SELECT id, name, color, price, image FROM products WHERE deleted IS NULL')->fetchall();
    foreach ($database_spinners as $spinner) {
      $spinners[$spinner['name']] = $spinner;
    }

    return $spinners;
}

//Matches products with the user who ordered them
function getProductsForUser($pdo, $userId) {
    $products = [];
    $database_products = $pdo->prepare('
        SELECT products.*, user_products.quantity
        FROM products
        INNER JOIN user_products ON user_products.product_id = products.id
        WHERE user_products.user_id = :userId
    ');
    $database_products->execute([
        ':userId' => $userId 
    ]);
    
    while ($item = $database_products->fetch()) {
      $products[$item['name']] = $item;
    }

    return $products;
}

//Updates quantity with new value for active user
function updateCart($pdo, $userId, $productId, $quantity) {
    $updateStatement = $pdo->prepare('
        UPDATE user_products
        SET quantity = :quantity
        WHERE product_id = :product_id
            AND user_id = :user_id
    ');
    
    $updateStatement->execute([
        ':user_id' => $userId,
        ':product_id' => $productId,
        ':quantity' => $quantity,
    ]);

    if ($updateStatement->rowCount() === 0) {
        insertToCart($pdo, $userId, $productId, $quantity);
    }
}

//Inserts values and assign them with id
function insertToCart($pdo, $userId, $productId, $quantity) {
    $statement = $pdo->prepare('
        INSERT INTO user_products (user_id, product_id, quantity)
        VALUES (:user_id, :product_id, :quantity)'
    );

    $statement->execute([
        ':user_id' => $userId,
        ':product_id' => $productId,
        ':quantity' => $quantity,
    ]);
}

//Empty cart for active user
function removeCartForUser($pdo, $userId) {
    $statement = $pdo->prepare('DELETE FROM user_products WHERE user_id = :userId');
    $statement->execute([
        ':userId' => $userId
    ]);
}

//Access active user values
function getUserById($pdo, $id) {
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :userId');
    $statement->execute([
        ':userId' => $id
    ]);

    return $statement->fetch();
}