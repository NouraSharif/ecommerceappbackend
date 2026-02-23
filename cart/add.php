<?php
include "../connect.php";

$usersid =filterRequest("usersid");
$itemsid =filterRequest("itemsid");


$data =array(
    "cart_usersid"=>$usersid,
    "cart_itemsid"=>$itemsid
);
insertData("cart",$data);



?>