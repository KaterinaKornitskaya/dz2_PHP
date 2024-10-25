<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySite</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>MySite</h1>
    <menu>

            <li>
                <a href="login.php">Login</a>
            </li>
            <li>
                <a href="addUser.php">Add User</a>
            </li>
            <li>
                <a href="showUsers.php">Show Users</a>
            </li>

    </menu>


    <?php
    include_once("myFunctions.php");
    $usersFile = fopen("users.txt","a+") or die("The file can not be opened");
    $usersArr = getUsersArr($usersFile);
    $usersCount = count($usersArr)-1;
    echo <<<USERS
    <p>Count of users now is $usersCount</p>
USERS;

    ?>

</body>
</html>

