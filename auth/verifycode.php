<?php
 include "../connect.php";

 $email= filterRequest("email");
 $verifycode=filterRequest("verifycode");


 $stmt=$con->prepare("SELECT * FROM users WHERE users_email=? AND users_verifycode=?");
 $stmt->execute(array($email,$verifycode));

 $count=$stmt->rowCount();

 if($count>0){
  $data=array(
    "users_approve"=>"1"
  );
  updateData("users",$data,"users_email='$email'",false);
  echo json_encode(array("status"=>"success","message"=>"Email verified successfully"));
}else{
    printFailure("Invalid Verify Code");
}




?>