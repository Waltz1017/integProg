<?php 
require 'connect.php';
header("Content-Type: application/json");

$id = $_GET['id'] ?? null;
    if(empty($id)){
    json_encode([
        "status" => "failed",
        "message" => "ID NOT FOUND."
    ]);
    exit();
}

$data = json_decode(file_get_contents("php://input"),true);

$brand = $data['brand'] ?? null;
$model = $data['model'] ?? null;
$year = $data['year'] ?? null;

try {
    $sql = "UPDATE cars
        SET brand = COALESCE(?, brand),
            model = COALESCE(?, model),
            year = COALESCE(?, year)
        WHERE id = ?";

    $stmt = $connect->prepare($sql);
    $stmt->execute([
        $brand,
        $model,
        $year,
        $id
    ]);

    if($stmt->rowCount()==0){
        echo json_encode([
            "status" => "failed",
            "message" => "Record NOT found or NO CHANGES made."
        ]);
    } else {
        echo json_encode([
            "status" => "success",
            "message" => "Car is updated."
        ]);
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>