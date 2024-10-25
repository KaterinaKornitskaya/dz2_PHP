<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Show Users</h1>
<table class="usersTable">
    <thead>
        <tr>
            <th></th>
            <th>Email</th>
            <th>Login</th>
            <th>Hashed Password</th>
        </tr>
    </thead>

    <?php
    include_once 'myFunctions.php';
    $usersFile = fopen("users.txt","a+") or die("The file can not be opened");
    $usArr = getUsersArr($usersFile);
    $count = 0;

    if(count($usArr) <= 1){
        echo <<<_END
        <tbody>
        <tr>
        <td>No Users</td>
        </tr>
        </tbody>
_END;

    }
    else{
        echo "<tbody>";
        foreach ($usArr as $user) {
            $count ++;
            echo "<tr>";
            // каждую строку нового юзера перевели в новый массив (разбили строку по символу |)
            $arrNextUser = preg_split("/[|]/", $user);
            if(count($arrNextUser) > 1) {
                echo <<<_END
            <td>$count</td>
            <td>$arrNextUser[0]</td>
            <td>$arrNextUser[1]</td>
            <td>$arrNextUser[2]</td>
_END;


            }
            echo "</tr>";
        }
        echo "</tbody>";

    }

?>
</table>
<p><a href="index.php">Back to main</a></p>
</body>
</html>

