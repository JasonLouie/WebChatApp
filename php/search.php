<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
    $searchTerm = "%$searchTerm%";
    $output = "";
    $sql = "SELECT * FROM users WHERE NOT unique_id = ? AND (username LIKE ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $outgoing_id, $searchTerm);
    $stmt->execute();
    $data = $stmt->get_result();
    if(mysqli_num_rows($data) > 0){
        include_once "data.php";
    }
    else{
        $output .= "No users found.";
    }
    $stmt->close();
    echo $output;
?>