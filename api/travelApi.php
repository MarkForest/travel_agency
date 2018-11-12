<?php

include_once "../views/functions.php";
connect();
$param = 'Неизвестный';
$token = 'anonymus';
$respnse = '';
if(isset($_POST['param']) && checkToken($_POST['token'])){
    switch ($_POST['param']){
        case 'getUsers':
        $usersResourse = mysql_query("select * from users");
        $error = mysql_errno();
        if($error){
            echo $error; die;
        }
        while($row = mysql_fetch_array($usersResourse, MYSQL_ASSOC)) {
                $respnse .= $row['login'].'|';
        }
        echo $respnse;
    }
}else{
    echo "<h1>Test</h1>";
}

