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
    http_response_code(400);
    echo json_encode([
        "status" => "failed",
        "message" => $e->getMessage()
    ]);
}

?>