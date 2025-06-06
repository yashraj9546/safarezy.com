<?php
    // $server_name= "sql210.infinityfree.com"; 
    // $user_name= "if0_38710352";
    // $password= "Yash8797465660";
    // $database= "if0_38710352_totoapp";

    $server_name= "localhost"; 
    $user_name= "root";
    $password= "";
    $database= "totoapp";

    $conn= mysqli_connect($server_name,$user_name,$password,$database);
     
    if(!$conn)
    {
        echo "connection was not stablished successfully due to ".mysqli_connect_error($conn);
    }
?>