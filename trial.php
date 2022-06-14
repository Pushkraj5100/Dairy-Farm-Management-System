<?php

    $con = mysqli_connect("localhost", "root", "","dbms");
          
    // Check connection
    if($con === false){
        die("ERROR: Could not connect. " 
            . mysqli_connect_error());
    }
    else
    {
        $cow = 1;
        $buff = 2;
        $bcow = $_POST["Bcowprise"];
        $bbuff =$_POST["Bbuffprise"];
        $scow = $_POST["Scowprise"];
        $sbuff = $_POST["Sbuffprise"];
        $entry1 = mysqli_query($con,"INSERT INTO `dailyrate` ( `type_id`, `buyer_rate`, `seller_rate`, `date`) VALUES ( $cow, $bcow, $scow, current_timestamp());");
        $entry2 = mysqli_query($con,"INSERT INTO `dailyrate` ( `type_id`, `buyer_rate`, `seller_rate`, `date`) VALUES ( $buff, $bbuff, $sbuff, current_timestamp());");
        if($entry1&&$entry2)
        {
            $url = 'page3.html';
            header('Location: '.$url);
        }
        else
        {
            echo "Wrong Entry!!!!!!";
        }
    }
?>
