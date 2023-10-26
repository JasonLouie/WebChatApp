<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ // If user is logged in, proceed to logout page. Else redirect to login
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){ // If logout id is set
            $status = "Offline now";
            $sql = "UPDATE users SET status = ? WHERE unique_id = ?";
            $data = $conn->execute_query($sql, [$status, $logout_id]);
            if (!$data){
                echo "Failure!";
            }
            else{
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }
        else{
            header("location: ../users.php");
        }
    }
    else{
        header("location: ../login.php");
    }

?>