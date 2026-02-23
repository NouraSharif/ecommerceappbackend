<?php
include "connect.php";

$dataAll=array();
$categories =getAllData("categories",null,null,false);
$dataAll['status']='success';
$dataAll['categories']=$categories;
$items =getAllData("itemsview","items_discount != 0",null,false);
$dataAll['items']=$items;
echo json_encode($dataAll);






?>