<?php

    $con = mysqli_connect("localhost", "root", "","dbms");
          
    // Check connection
    if($con === false){
        die("ERROR: Could not connect. " 
            . mysqli_connect_error());
    }
    else
    {
        $v1 = mysqli_query($con, "SELECT * FROM `buyerinfo` ");
        $v2 = mysqli_query($con, "SELECT * FROM `sellerinfo` ");
        echo "<table>";
        while($row = mysql_fetch_array($v1)){   //Creates a loop to loop through results
            echo "<tr><td>" . $row['buyer_name'] . "</td><td>" . $row['mobile'] . "</td><td>" . $row['bill'] . "</td></tr>";  
            }
        while($row = mysql_fetch_array($v2)){   //Creates a loop to loop through results
            echo "<tr><td>" . $row['seller_name'] . "</td><td>" . $row['mobile'] . "</td><td>" . $row['bill'] . "</td></tr>";  
            }
            echo "</table>";
    }
    mysql_close();
?>
