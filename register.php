<?php
include 'server/connection.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $checkQuery = "SELECT * FROM users WHERE user_name = '$username'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        //jika terdapate duplikat data makan tidak akan berproses
        echo "Username already exist. Please choose a different username.";
    } else {
        //proses insert data jika tidak ada data duplikat
        $query = "INSERT INTO users (user_name,user_password) VALUES ('$username','$password')";
        mysqli_query($conn, $query);
        echo "Record inserted successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Test</h1>
    <form method="POST" action="register.php">
        <p>Username</p>
        <input type="text" name="username" required>
        <p>Password</p>
        <input type="password" name="password" required>
        <button type="submit">
            Register
        </button>
    </form>

</body>

</html>