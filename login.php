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
    <title>Login | Chat App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <section class="form login">
            <header>Web Chat App</header>
            <form action="" method="post">
                <div class="error-login"></div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="off">
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="button input">
                    <input type="submit" value="Login" name="submit">
                </div>
            </form>
            <div class="link">Not signed up yet? <a href="index.php">Sign up here</a></div>
        </div>
    </div>
    <script src="scripts/pass-show-hide.js"></script>
    <script src="scripts/login.js"></script>
</body>
</html>