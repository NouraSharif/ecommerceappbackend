<?php
include "../connect.php";


$email = filterRequest("email");
$verifycode = rand(10000,99999);

//بحاج اني اعمل ابديت للداتا 
$data = array(
    "users_verifycode" => $verifycode
);
$count = updateData("users", $data, "users_email='$email'",false);

if($count > 0) {
    sendEmail($email, "Verify Code", "Your verify code is $verifycode");
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"failure"]);
}


?>