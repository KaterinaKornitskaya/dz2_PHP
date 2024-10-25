<?php

// ф-ия для получения массива строк файла с пользователями
function getUsersArr($usersFile){
    // переменная для содержимого файла
    $fileContent = "";

    // считываем файл в fileContent
    while(!feof($usersFile)){
        $fileContent .= fgets($usersFile);
    }

    // массив юзеров (массив из строк файла), делим на массив по символу новой строки
    $usersArr = preg_split("/[\s]/", $fileContent);
    //print_r($usersArr);
    return $usersArr;
}

// ф-ия для авторизации пользователя
function Login($login, $password)
{
    $usersFile = fopen("users.txt","a+") or die("The file can not be opened");

    // считаем файл(если существует) и получим массив записей о пользователях
    $usersArr = getUsersArr($usersFile );
    //print_r($usersArr);

    $hash = password_hash($password, PASSWORD_DEFAULT);


    foreach ($usersArr as $user){
        $userStr = preg_split("/[|]/", $user);
        if(count($userStr) > 1){
            if($userStr[1] == $login && password_verify($password, $userStr[2])){
                return true;
            }
        }
    }
    return false;
}

// ф-ия для записи пользователя в файл
function  addUser($fl, $usersFile, $email, $login, $hashPassword)
{
    if($fl === true){
        // записываем нового пользователя в файл
        if(fwrite($usersFile,$email."|".$login."|".$hashPassword."\n")){
            echo "<p>File successfully written!</p>";
        }
        else{
            echo "<p>The file can not be written!</p>";
        }
    }
    else{
        echo "<p>User already exists.</p>";
    }
}

// ф-ия для проверки уникальности логина
function  isLoginUnique($arrLogins, $login)
{
    $fl = true;
    foreach ($arrLogins as $item){
        if($item!=$login){
            continue;
        }
        else{
            $fl = false;
        }
    }
    return $fl;
}

// ф-ия для получения массива логинов
function getLoginsArr($usersArr){
    // массив логинов
    $arrLogins = [];
    foreach ($usersArr as $item){
        // каждую строку нового юзера перевели в новый массив (разбили строку по символу |)
        $arrNextUser = preg_split("/[|]/", $item);
        if(count($arrNextUser) > 1){
            // в массив логинов добавляем логины из каждой строки (0ой элемент массива arrStr)
            array_push($arrLogins, $arrNextUser[1]);
        }

    }
    return $arrLogins;
}

?>
