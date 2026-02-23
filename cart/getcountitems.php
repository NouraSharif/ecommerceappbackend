<?php

include "../connect.php";

$usersid =filterRequest("usersid");
$itemsid=filterRequest("itemsid");

$stmt=$con->prepare("SELECT COUNT(cart.cart_itemsid) as itemscount FROM cart WHERE cart_usersid=$usersid AND cart_itemsid=$itemsid");
$stmt->execute();

$data= $stmt->fetchColumn();

$count =$stmt->rowCount();
if($count > 0){
   echo json_encode(array("status"=>"success","data"=>$data));
}else{
   echo json_encode(array("status"=>"success","data"=>"0"));
}








?>