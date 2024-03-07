<?php
session_start();
include("server/connection.php");

if (!isset($_SESSION["logged_in"])) {
    header('location: index.php');
    exit;
}

if (isset($_GET["logout"])) {
    if (isset($_SESSION["logged_in"])) {
        unset($_SESSION["logged_in"]);
        unset($_SESSION["user_email"]);
        header("location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatoble" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    Selamat Datang!
    <?php echo $_SESSION["user_name"] ?><br>
    <div class="info_user">
        <p>username : <?php echo $_SESSION["user_name"] ?></p><br>
    </div>
    <a href="Welcome.php?logout=1" id="logout-btn" >
        <button>Logout</button>
    </a>
</body>
</html>