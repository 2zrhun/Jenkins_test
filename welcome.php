<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Bonjour, <?php echo $username; ?>!</h1>
    <form method="post" action="logout.php">
        <input type="submit" name="submit" value="Logout">
    </form>
</body>
</html>
