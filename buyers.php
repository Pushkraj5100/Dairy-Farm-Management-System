<?php

    $con = mysqli_connect("localhost", "root", "","dbms");
          
    // Check connection
    if($con === false){
        die("ERROR: Could not connect. " 
            . mysqli_connect_error());
    }
    else
    {
        $v1 = $_POST['Bname'];
        $v2 = $_POST['Bno'];
        $v3 = $_POST['Bquantity'];
        $v4 = $_POST['bcow'];
        $v6 = mysqli_query($con, "SELECT quantity FROM `totalmilk` WHERE type_id = 1");
        $v7 = mysqli_query($con, "SELECT quantity FROM `totalmilk` WHERE type_id = 2");
        $v8 = mysqli_query($con, "SELECT buyer_rate FROM `dailyrate` WHERE type_id = 1 and date = CURRENT_DATE");
        $v9 = mysqli_query($con, "SELECT buyer_rate FROM `dailyrate` WHERE type_id = 2 and date = CURRENT_DATE");
        $row1 = mysqli_fetch_array($v6, MYSQLI_ASSOC);
        $row2 = mysqli_fetch_array($v7, MYSQLI_ASSOC);
        $ccost = mysqli_fetch_array($v8, MYSQLI_ASSOC);
        $bcost = mysqli_fetch_array($v9, MYSQLI_ASSOC);
        if($v4==1)
        {
            if($row1['quantity']>=(int)$v3)
            {
                $row1['quantity'] = $row1['quantity']-(int)$v3;
                $k=$row1['quantity'];
                mysqli_query($con,"UPDATE totalmilk SET quantity = $k WHERE type_id = 1");
                $bill = (int)$v3*(int)$ccost['buyer_rate'];
                mysqli_query($con,"INSERT INTO `buyerinfo` ( `type_id`,`buyer_name`, `mobile`, `quantity`, `bill`, `date`) VALUES ( '1','$v1','$v2', '$v3', '$bill', current_timestamp())");
                // mysqli_query($con,"INSERT INTO `buyerinfo` (``)");
                echo "Your Bill is {$bill} rs.";
            }
            else {
                echo "Milk is not available";
            }
        }
        else
        {
            if($row2['quantity']>=$v3)
            {
                $row2['quantity'] =$row2['quantity']-(int)$v3;
                $k=$row2['quantity'];
                mysqli_query($con,"UPDATE totalmilk SET quantity = $k WHERE type_id = 2");
                $bill = $v3*$bcost['buyer_rate'];
                mysqli_query($con,"INSERT INTO `buyerinfo` ( `type_id`, `buyer_name`, `mobile`, `quantity`, `bill`, `date`) VALUES ( '2', '$v1', '$v2', '$v3', '$bill', current_timestamp())");
                echo "Your Bill is {$bill} rs.";
            }
            else {
                echo "Milk is not available";
            }
        }
    }
?>
