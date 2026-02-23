<?php
//include "./connect.php";
/*
$data = array(
    "users_name" => "testuser",
    "users_email" => "noura@gmail.com",
    "users_password" => "123456",
    "users_phone"=>"05673774373",
    'users_verifycode'=>"00988"
);

insertData("users",$data);
*/
/*
require_once 'phpmailer/mail.php';

// إنشاء كائن جديد كل مرة
$mail = createMailer();

$mail->setFrom('sharifnoura413@gmail.com', "noura hassanin");
$mail->addAddress('nourahassanin413@gmail.com');
$mail->Subject = 'Here is the subject';
$mail->Body = 'This is the HTML message body <b>in bold!</b>';

if($mail->send()) {
    echo "تم إرسال البريد بنجاح";
} else {
    echo "فشل الإرسال: " . $mail->ErrorInfo;
}
*/

include "connect.php";

//getAllData("users","1=1");

//sendEmail("nourahassanin413@gmail.com", "Test Subject", "Test Body");

$imagename = imageUpload("file");
$itemsname=$_POST['name'];
$itemsnamear=$_POST['namear'];
$itemscat=$_POST['itemscat'];

$stmt = $con->prepare("INSERT INTO items ( `items_name`, `items_name_ar`, `items_image`, `items_cat`) VALUES (?,?,?,?)");
$stmt->execute([$itemsname,$itemsnamear,$imagename,$itemscat]);



?>