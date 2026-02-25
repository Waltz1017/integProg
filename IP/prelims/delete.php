<?php 
require 'connect.php';
header("Content-Type: application/json");

$id = $_GET['id'] ?? null;
    if(empty($id)){
    echo json_encode([
        "status" => "failed",
        "message" => "ID NOT FOUND."
    ]);
    exit();
}

try {
    $sql = "DELETE FROM cars WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->execute([$id]);

    if($stmt->rowCount()==0){
        echo json_encode([
            "status" => "failed",
            "message" => "Record NOT found or NO CHANGES made."
        ]);
    } else {
        echo json_encode([
            "status" => "success",
            "message" => "Car is deleted."
        ]);
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>