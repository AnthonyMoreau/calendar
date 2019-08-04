<?php 

$db_charset = "UTF8";

$db_name = "agenda";
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "root";

if(!isset($pdo)){

    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host;charset=$db_charset", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} else {

    return $pdo;
    
}
