<?php
session_start();

require '../includes/database_connection.php';


$username = $_POST["username"];
$password = $_POST["password"];

$statement = $pdo->prepare("SELECT * FROM users
  WHERE username = :username");

$statement->execute(
  [
    ":username" => $username
  ]
);

$fetched_user = $statement->fetch();

$is_password_correct = password_verify($password, $fetched_user["password"]);
if($is_password_correct){
  
  $_SESSION["username"] = $fetched_user["username"];
  $_SESSION["user_id"] = $fetched_user["id"];
  
  header('Location: /index.php');
} else {
  header('Location: /index.php?login_failed=true');
}