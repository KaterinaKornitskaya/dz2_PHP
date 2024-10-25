<?php

$usersFile = fopen("users.tsx","a+") or die("The file can not be opened");
$fileContent = "";
while(!feof($usersFile)){
    $fileContent .= fgets($usersFile);


}


// users array
$usersArr = preg_split("/[\s]/", $fileContent);
print_r($usersArr);

// email array
$arrLogins = [];
echo "<br>";
foreach ($usersArr as $item){
    // каждую строку нового юзера перевели в массив (разбили строку по символу |)
    $arrNextUser = preg_split("/[|]/", $item);
    echo "<br>";
    print_r($arrNextUser);
    echo "<br>";
    if(count($arrNextUser) > 1){
        // в массив arrLogins добавляем логины из каждой строки (0ой элемент массива arrStr)
        array_push($arrLogins, $arrNextUser[0]);
    }

}
echo "<br>";
print_r($arrLogins);

fclose($usersFile);

?>
