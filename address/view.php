<?php
include "../connect.php";

$table ="address",

$usersid = filterRequest("usersid");
getAllData($table,"address_usersid=$usersid");



?>