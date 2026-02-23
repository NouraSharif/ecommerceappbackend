<?php
 include "../connect.php";

 $email= filterRequest("email");
 $verifycode=filterRequest("verifycode");


 $stmt=$con->prepare("SELECT * FROM users WHERE users_email=? AND users_verifycode=?");
 $stmt->execute(array($email,$verifycode));

 $count=$stmt->rowCount();
 result($count);




?>