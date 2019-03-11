<?php

require '../includes/database_connection.php';

$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];
$adress = $_POST["adress"];
$phone = $_POST["phone"];
$email = $_POST["email"];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$statement = $pdo->prepare("INSERT INTO users
  (username, password, fullname, adress, phone, email) VALUES (:username, :password, :fullname, :adress, :phone, :email)");

$statement->execute(
  [
    ":username" => $username,
    ":password" => $hashed_password,
    ":fullname" => $fullname,
    ":adress" => $adress,
    ":phone" => $phone,
    ":email" => $email
  ]
);
header('Location: /index.php');