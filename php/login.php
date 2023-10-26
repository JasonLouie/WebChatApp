<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($email) && !empty($password)) {
        // Check if email and pass matches db
        $sql = "SELECT * FROM users WHERE email=?";
        $data = $conn->execute_query($sql, [$email]);
        if(mysqli_num_rows($data) > 0) {
            $row = mysqli_fetch_assoc($data);
            if (password_verify($password, $row['password'])) {
                // Update user status to Active Now upon successful login
                $status = "Active now";
                $sql2 = "UPDATE users SET status = ? WHERE unique_id = ?";
                $data2 = $conn->execute_query($sql2, [$status, $row['unique_id']]);
                if (!$data2){
                    echo "Failure!";
                }
                else{
                    $_SESSION['unique_id'] = $row['unique_id'];
                    echo "success";
                }
            }
            else{ // Wrong password, but for ambiguity state that at least one of the two fields are incorrect.
                echo "Email or password is incorrect!";
            }
        }
        else{ // Email doesn't exist, but for ambiguity state that at least one of the two fields are incorrect.
            echo "Email or password is incorrect!";
        }
    }
    else{
        echo "All input fields are required!";
    }
?>