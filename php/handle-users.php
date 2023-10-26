<?php
    session_start();
    $outgoing_id = $_SESSION['unique_id'];
    include_once "config.php";
    $sql = "SELECT * FROM users WHERE NOT unique_id = ?";
    $data = $conn->execute_query($sql, [$outgoing_id]);
    $output = "";

    if(mysqli_num_rows($data) == 0){
        $output .= "No users are available to chat";
    }
    elseif(mysqli_num_rows($data) > 0){
        include_once "data.php";
    }
    echo $output;
?>