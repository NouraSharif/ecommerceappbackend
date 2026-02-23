<?php

include "../connect.php";


/*
رح اعمل حذف للمنتج 
لكن هو كمية ما رح احذفها مرة وحدة 
LiMIT 1
*/

$usersid =filterRequest("usersid");
$itemsid =filterRequest("itemsid");

deleteData("cart","cart_usersid = $usersid AND cart_itemsid = $itemsid LIMIT 1");    









?>