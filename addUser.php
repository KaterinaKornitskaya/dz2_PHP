<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add User</h1>

    <form action="addUser.php" method="post">
        <label>
            <input type="email" name="email" value="" placeholder="Email">
        </label>

        <label>
            <input type="text" name="login" value="" placeholder="Login">
        </label>

        <label>
            <input type="password" name="password" value="" placeholder="Password">
        </label>

        <input type="submit" value="Submit">
    </form>

    <p><a href="index.php">Back to main</a></p>

    <?php
    include_once("myFunctions.php");

    // если данные из формы были отправлены
    if(isset($_POST["email"]) && isset($_POST["login"]) && isset($_POST["password"])){

        $email = htmlentities($_POST['email']);
        $login = htmlentities($_POST['login']);
        $password = htmlentities($_POST['password']);

        if($email == "" || $login == "" || $password == ""){
            echo "<p>Please, fill all fields!</p>";
            return;
        }
        else{
            // хешируем пароль
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $usersFile = fopen("users.txt","a+") or die("The file can not be opened");

            // считаем файл(если существует) и получим массив записей о пользователях
            $usersArr = getUsersArr($usersFile );

            // получим массив логинов для последующей проверки уникальности логина
            $arrLogins = getLoginsArr($usersArr);

            // флаг для проверки существует ли такой логин
            $fl = isLoginUnique($arrLogins, $login);

            // запись нового пользователя в файл
            addUser($fl, $usersFile, $email, $login, $hashPassword);

            fclose($usersFile);
        }
    }

    ?>


</body>
</html>

<?php
?>
