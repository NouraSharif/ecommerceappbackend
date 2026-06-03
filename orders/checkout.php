<?php

include "../connect.php";

$usersid       =filterRequest("usersid");
$addressid     =filterRequest("addressid");
$orderstype    =filterRequest("orderstype");
$pricedelivery =filterRequest("pricedelivery");
$ordersprice   =filterRequest("ordersprice");
$couponid      =filterRequest("couponid");
$paymentmethod =filterRequest("paymentmethod");

$data = array(
    "orders_usersid" => $usersid,
    "orders_address" => $addressid,
    "orders_type" => $orderstype,
    "orders_pricedelivery" => $pricedelivery,
    "orders_price" => $ordersprice,
    "orders_coupon" => $couponid,
    "orders_paymentmethod" => $paymentmethod,
);

$count = insertData("orders" ,$data, false);

if($count > 0){
    $stmt =$con->prepare("SELECT MAX(orders_id) FROM orders ");
    $stmt->execute();
    $maxid =$stmt->fetchColumn();

    $data = array(
        "cart_orders" => $maxid,
    );

    updateData("cart",$data,"cart_usersid=$usersid AND cart_orders =0");

}









?>