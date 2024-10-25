<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Login Page</h1>

<form action="login.php" method="post">
    <label>
        <input type="text" name="login" value="" placeholder="Login">
    </label>

    <label>
        <input type="password" name="password" value="" placeholder="Password">
    </label>

    <input type="submit" value="Login">
</form>

<?php
    include_once("myFunctions.php");

    if(isset($_POST["login"]) && isset($_POST["password"])){
        $login = $_POST["login"];
        $password = $_POST["password"];

        if(Login($login, $password)){
            echo "<p>You are authorized, thank you!</p>";
        }
        else{
            echo "<p>Login or password is incorrect!</p>";
        }
    }

?>

<p><a href="index.php">Back to main</a></p>
</body>
</html>

<?php
?>