<?php 
require 'connect.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"),true);

$brand = $data['brand'] ?? null;
$model = $data['model'] ?? null;
$year = $data['year'] ?? null;

if(empty($brand) || empty($model) || empty($year)){
    http_response_code(400);
    echo json_encode([
        "status" => "failed",
        "message" => "All field are required."
    ]);
    exit();
}

try{
$sql = "INSERT INTO cars(brand, model, year) VALUES (?, ?, ?)";
$stmt = $connect->prepare($sql);

$stmt->execute([
    $brand,
    $model,
    $year
]);
    echo json_encode([
        "status" => "success",
        "message" => "New data added to database."
    ]);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>