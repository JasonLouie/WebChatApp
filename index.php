<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ // If user is already logged in
        header("location: users.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Chat App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <section class="form signup">
            <header>Web Chat App</header>
            <form action="" method="post">
                <div class="message"></div>
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field input">
                    <label for="repeat_password">Confirm your Password</label>
                    <input type="password" id="repeat_password" name="repeat_password" placeholder="Confirm password" required>
                </div>
                <div class="field image">
                    <label for="image">Select Profile Picture</label>
                    <input type="file" id="image" name="image" required>
                </div>
                <div class="button input">
                    <input type="submit" value="Login" name="submit">
                </div>
            </form>
            <div class="link">Already registered? <a href="login.php">Login here</a></div>
        </section>
    </div>
    <script src="scripts/pass-show-hide.js"></script>
    <script src="scripts/signup.js"></script>
</body>
</html>