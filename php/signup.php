<?php
    session_start();
    include_once "config.php";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $repeatPassword = mysqli_real_escape_string($conn, $_POST['repeat_password']);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();
    
    if (!empty($username) && !empty($email) && !empty($password) && !empty($repeatPassword)) {
        if(strlen($username) < 3){
            array_push($errors,"Username must be at least 3 characters long!");
        }
        else{
            $sql_user = "SELECT username FROM users WHERE username = ?";
            $data_user = $conn->execute_query($sql_user, [$username]);
            if(mysqli_num_rows($data_user) > 0){
                array_push($errors, "Username $username is taken!");
            }
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "$email is not a valid email!");
        }
        else{
            $sql_email = "SELECT email FROM users WHERE email = ?";
            $data_email = $conn->execute_query($sql_email, [$email]);
            if(mysqli_num_rows($data_email) > 0){
                array_push($errors, "An account with $email already exists!");
            }
        }
        if (strlen($password) < 8){
            array_push($errors, "Password must be at least 8 characters long!");
        }
        if ($password !== $repeatPassword) {
            array_push($errors, "Password does not match!");
        }
        // Check if user uploaded file
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $img_name = $_FILES['image']['name']; // User uploaded img name
            $tmp_name = $_FILES['image']['tmp_name']; // Temp name used to save/move file in our folder

            // Explode image to get the last extension
            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode); // Get the extension of user uploaded img

            $extensions = ['png', 'jpeg', 'jpg']; // Array of valid img extensions
            if (in_array($img_ext, $extensions) === true){
                $time = time(); // Returns current time. Uploaded user img will be renamed to the current time so it will be unique

                $new_img_name = $time.$img_name; // Rename img name to be curr time followed by img name.

                // Move user uploaded img to a folder only if there aren't any errors
                if(count($errors) === 0){
                    if(move_uploaded_file($tmp_name, "images/".$new_img_name)){
                        $status = "Active now"; // User status is active upon signing up
                        $random_id = rand(time(), 10000000); // Create random id for user
                    }
                }
            }
            else{
                array_push($errors, "Please select a jpeg, jpg, or png!");
            }
        }
        else{
            array_push($errors, "Upload a profile picture!");
        }
        if (count($errors) > 0){
            // Display existing errors
            foreach ($errors as $error){
                echo "$error|";
            }
        }
        else{
            // Insert user data inside table
            $sql2 = "INSERT INTO users (unique_id, username, email, password, img, status) VALUES ( ?, ?, ?, ?, ?, ? )";
            $data = $conn->execute_query($sql2, [$random_id, $username, $email, $passwordHash, $new_img_name, $status]);
            if ($data) {
                $sql3 = "SELECT * FROM users WHERE email = ?";
                $data2 = $conn->execute_query($sql3, [$email]);
                if($data2->num_rows > 0){
                    $row = mysqli_fetch_assoc($data2);
                    $_SESSION['unique_id'] = $row['unique_id']; //Use unique id for user session in other php
                    echo "success";
                }
            }
            else{
                die("Something went wrong!");
            }
        }
    }
    else{
        echo "All input fields are required!";
    }
?>