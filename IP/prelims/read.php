<?php 
require 'connect.php';
header("Content-Type: application/json");

try {
    $sql = "SELECT * FROM cars";
    $stmt = $connect->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($stmt->rowCount()==0){
        echo json_encode([
            "Record NOT found."
        ]);
    } else {
        echo json_encode($result);
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}


?>