<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$dsn = "mysql:host=localhost;dbname=ecommerce";
$user = "root";
$pass = "";

$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
);

try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    include "function.php";
    //checkAuthenticate();

} catch(PDOException $e) {
    echo json_encode(array("message" => "Connection failed: " . $e->getMessage()));
    exit();
}
?>