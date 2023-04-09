<?php

//echo password_hash('12345',PASSWORD_BCRYPT);
session_start();
if (isset($_SESSION['username'])) {
    header('Location: welcome.php');
    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "btc24";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM utilisateurs WHERE user_name='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0 ) {
        $row = $result->fetch_assoc();
        $hash= password_hash('12345',PASSWORD_BCRYPT);
        if (password_verify($password, $hash)) {
            $_SESSION['username'] = $username;
            header('Location: welcome.php');
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username"><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
