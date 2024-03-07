<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: welcome.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $query = "SELECT * FROM users WHERE user_email = ? AND user_password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $email, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result(
            $user_id,
            $user_name,
            $user_email,
            $user_password,
            $user_phone,
            $user_address,
            $user_city,
            $user_photo
        );
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['user_address'] = $user_address;
            $_SESSION['user_city'] = $user_city;
            $_SESSION['user_photo'] = $user_photo;
            $_SESSION['logged_in'] = true;

            header('location: welcome.php?message=Logged in succesfully');
        } else {
            header('location: index.php?error=Cound not verify your account');
        }
    } else {
        header('location: index.php?error=Something went wrong!');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <div class="top">
            <img src="image/mail_putih.png" alt="ikon_mail">
            <h1>welcome back!</h1>
        </div>

        <form action="index.php" method="post" autocomplete="off" id="login-form">
            <?php if (isset($_GET["error"])) {
                echo $_GET["error"];
            }
            ?>
            <div class="bottom">
                <div class="form">
                    <input autocomplete="new-email" type="email" name="user_email" placeholder="Email address">
                    <input autocomplete="new-password" type="password" name="user_password" placeholder="Password">
                </div>
                <div class="button-login">
                    <!-- <button>Login</button> -->
                    <input type="submit" id="login_btn" name="login_btn" value="Login">
                </div>
            </div>
        </form>

        <div class="footer">
            <a href="">forgot your password?</a>
            <a href="">don't have an account?</a>
        </div>
    </div>

</body>

</html>