<?php

$con = mysqli_connect("localhost", "root", "", "dbms");

// Check connection
if ($con === false) {
    die("ERROR: Could not connect. "
        . mysqli_connect_error());
} else {
    $v1 = $_POST['Sname'];
    $v2 = $_POST['Sno'];
    $v3 = $_POST['Squantity'];
    $v4 = $_POST['Sfat'];
    $v5 = $_POST['scow'];
    $v7 = mysqli_query($con, "SELECT quantity FROM `totalmilk` WHERE type_id = 1");
    $v8 = mysqli_query($con, "SELECT quantity FROM `totalmilk` WHERE type_id = 2");
    $v9 = mysqli_query($con, "SELECT buyer_rate FROM `dailyrate` WHERE type_id = 1 and date = CURRENT_DATE");
    $v10 = mysqli_query($con, "SELECT buyer_rate FROM `dailyrate` WHERE type_id = 2 and date = CURRENT_DATE");
    $row1 = mysqli_fetch_array($v7, MYSQLI_ASSOC);
    $row2 = mysqli_fetch_array($v8, MYSQLI_ASSOC);
    $ccost = mysqli_fetch_array($v9, MYSQLI_ASSOC);
    $bcost = mysqli_fetch_array($v10, MYSQLI_ASSOC);
    if ($v5 == 1) {
        if (isset($ccost['buyer_rate'])) {
            $bill = $ccost['buyer_rate'] * (int)$v4 * (int)$v3;
            $row1 = $row1['quantity'] + (int)$v3;
            mysqli_query($con, "UPDATE totalmilk SET quantity = $row1 WHERE type_id = 1");
            mysqli_query($con, "INSERT INTO `sellerinfo` ( `type_id`, `seller_name`, `mobile`, `quantity`, `fat`, `bill`, `date`) VALUES ( '1', '$v1', '$v2', '$v3', '$v4', '$bill', current_timestamp())");
            echo "Your Bill is {$bill} rs.";
        }
    } else {
        if (isset($bcost['buyer_rate'])) {
            $bill = $bcost['buyer_rate'] * (int)$v4 * (int)$v3;
            $row2['quantity'] = $row2['quantity'] + (int)$v3;
            $k = $row2['quantity'];
            mysqli_query($con, "UPDATE totalmilk SET quantity = $k WHERE type_id = 2");
            mysqli_query($con, "INSERT INTO `sellerinfo` ( `type_id`, `seller_name`, `mobile`, `quantity`, `fat`, `bill`, `date`) VALUES ( '2', '$v1', '$v2', '$v3', '$v4', '$bill', current_timestamp());");
            echo "Your Bill is {$bill} rs.";
        }
    }
}

