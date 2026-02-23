<?php
include "../connect.php";

$table ="address";

$addressid =filterRequest("addressid")


deleteData($table, "address_id =$addressid");

?>