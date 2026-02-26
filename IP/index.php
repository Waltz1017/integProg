<?php 
require 'konek.php';
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace("/balistirus", "", $uri);
$urlParts = explode("/",trim($uri, "/"));
//print_r($urlParts);
//echo $urlParts[0];
if($urlParts[0]=="users"){
    if($method == "GET" && count($urlParts)==1){
        try {
            require './apis/get.php'; //get.php directory
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    elseif($method == "GET" && count($urlParts) == 2){
        try{
            $id=$urlParts[1];
            $sql="SELECT * FROM student where id=?";
            $stmt=$konek->prepare($sql);
            $stmt->execute([$id]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            http_response_code(200);
            echo json_encode($result);
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}
else {
    http_response_code(400);
    echo json_encode([
        "status"=>"failed",
        "message"=>"INVALID URL"
    ]);
}       

?>