<?php 

$serverName= 'localhost';
$userName= 'root';
$password = '';
$dbName= 'php-blog';
global $pdo;
try{

    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    );
    $pdo = new PDO("mysql:host=$serverName;dbname=$dbName", $userName , $password, $options);
    return $pdo;

}catch(PDOException $e){
    echo $e->getMessage();
    exit;
}