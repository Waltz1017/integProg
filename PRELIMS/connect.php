<?php 
$serverhost = "localhost";
$username = "root";
$password = "";

try {
    $connect = new PDO("mysql:host=$serverhost;dbname=car", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "the database is connected";
}
catch (PDOException $e){
    echo $e->getMessage();
}

?>