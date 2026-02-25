<?php 
$serverhost = "localhost";
$username = "root";
$password = "";

try {
$konek = new PDO("mysql:host=$serverhost;dbname=info1", $username, $password);
$konek->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "connected";
}
catch (PDOException $e){
    echo $e->getMessage();
}

?>