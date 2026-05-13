<?php

include "../connect.php";

$table ="coupon";

$couponName = filterRequest("couponname");

getAllData($table, "coupon_name='$couponName' And coupon_count > 0 And coupon_expiredate > now() ");








?>