<?php
    include 'config/db_conn.php';

    $conn = getConnection();

    $username = $_GET['username'];
    $code = $_GET['code'];
    
    $emailquery = $conn->query("SELECT * FROM `users` WHERE `username` = '$username'");
    while ($row = $emailquery->fetch(PDO::FETCH_ASSOC)){
        
        $db_code = $row['confirmed_code'];
    }
    if($code == $db_code){
        $query = "UPDATE users SET confirmed= '1', confirmed_code= '0'";
        $update=updateusers($query);

        if ($update != 0){
            echo "account successfully";
        }
        else{
            echo "error in updating query";
        }
    }
    else{
        echo "Username and code dont match";
    }
    header('location: login.php');
?>