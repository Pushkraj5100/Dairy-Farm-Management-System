<?php

    $con = mysqli_connect("localhost", "root", "","dbms");
          
    // Check connection
    if($con === false){
        die("ERROR: Could not connect. " 
            . mysqli_connect_error());
    }
    else
    {
        $username = $_POST["username"];
        $pass =$_POST["password"];
        $userdb = mysqli_query($con, "SELECT username FROM `users` WHERE no = 1");
        $passdb = mysqli_query($con, "SELECT password FROM `users` WHERE no = 1");
        $row1 = mysqli_fetch_array($userdb, MYSQLI_ASSOC);
        $row2 = mysqli_fetch_array($passdb, MYSQLI_ASSOC);
        mysqli_query($con,"UPDATE totalmilk SET quantity = 0 WHERE type_id = 1");
        mysqli_query($con,"UPDATE totalmilk SET quantity = 0 WHERE type_id = 2");
        if($username==$row1['username']&&$pass==$row2['password'])
        {
            $url = 'trial.html';
            header('Location: '.$url);
        }
        else{
            $url = 'index.html';
            echo "<script>alert('Enter correct Details')</script>";
            header('Location: '.$url);
        }
    }
?>
