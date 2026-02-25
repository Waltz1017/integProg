<?php 
require 'konek.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'] ?? null;
$course = $data['course'] ?? null;
$year = $data['year'] ?? null;

if(empty($name) || empty($course) || empty($year)){
    http_response_code(400);
    echo json_encode([
        "status" => "failed",
        "message" => "All field are required"
    ]);
    exit();
}

try {
    $sql = "INSERT INTO student (name, course, year) VALUES (?, ?, ?)";
    $stmt=$konek->prepare($sql);
    $stmt->execute([
        $name,
        $course,
        $year,
    ]);

    echo json_encode([
        "status"=>"success",
        "message"=>"new info added in database"
    ]);
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>