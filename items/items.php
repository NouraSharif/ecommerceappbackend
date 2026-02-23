<?php

include "../connect.php";

$categoriesid =filterRequest("id");

$usersid =filterRequest("usersid");
//getAllData("itemsview","categories_id=$categoriesid",null,true);
$stmt =$con->prepare("SELECT itemsview.* ,1 AS favorite,(items_price-(items_price* items_discount/100)) AS itemspricediscount FROM `itemsview` 
INNER JOIN favorite ON favorite.favorite_usersid= $usersid AND favorite.favorite_itemsid=itemsview.items_id
WHERE itemsview.categories_id=$categoriesid
UNION ALL
SELECT *,0 AS favorite, (items_price-(items_price* items_discount/100)) AS itemspricediscount FROM `itemsview` 
WHERE itemsview.categories_id=$categoriesid AND itemsview.items_id  NOT IN (SELECT itemsview.items_id FROM `itemsview` INNER JOIN favorite ON favorite.favorite_usersid= $usersid AND favorite.favorite_itemsid=itemsview.items_id 
)
");
$stmt->execute();
$data =$stmt->fetchAll(PDO::FETCH_ASSOC);
$count =$stmt->rowCount();
if($count>0){
    echo json_encode(array("status"=>"success","data"=>$data));
}else{
    echo json_encode(array("status"=>"failur"));
}
?>