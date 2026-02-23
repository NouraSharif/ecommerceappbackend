<?php
include "../connect.php";

$email = filterRequest("email");
$verifycode = rand(10000,99999);

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
$stmt->execute([$email]);

$count = $stmt->rowCount();
result($count);

if ($count > 0) {
    sendEmail($email, "Verify Code", "Your verify code is $verifycode");
    $data = array(
        "users_verifycode" => $verifycode
    );
    updateData("users", $data, "users_email='$email'", false);
}
?>
