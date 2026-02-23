<?php
include "../connect.php";

$username =filterRequest("username");   
$password=sha1(filterRequest("password"));
$email =filterRequest("email");
$phone =filterRequest("phone");
$verifycode=rand(10000,99999);

$stmt =$con->prepare("SELECT * FROM users WHERE users_email=? AND users_phone=?");
$stmt->execute(array($email,$phone));


$count =$stmt->rowCount();

if($count>0){
    printFailure("Email or Phone already exists");
}else{
    $data =array(
        "users_name" => $username,
        "users_email" => $email,
        "users_password" => $password,
        "users_phone"=>$phone,
        'users_verifycode'=>$verifycode
    );
    sendEmail($email,"VerifyCode Ecommerce App","VerifyCode is $verifycode");
    insertData("users",$data);
}







?>