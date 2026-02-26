<?php 
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? null;
$password = $data['password'] ?? null;
$program = $data['program'] ?? null;

if(empty($id)){
    http_response_code(400);
    echo json_encode([
        "status" => "failed",
        "message" => "Missing ID"
    ]);
    exit();
}
try{
    $sql="DELETE FROM student WHERE id=?";
    $stmt=$konek->prepare($sql);
    $stmt->execute([$id]);

    if($stmt->rowCount()==0){
        echo json_encode([
            "status"=>"failed",
            "message"=>"No record found"
        ]);
    }
    else {
        echo json_encode([
            "status"=>"success",
            "message"=>"Account deleted"
        ]);
    }
}
catch(PDOException $e) {
    http_response_code(400);
    echo json_encode([
        "status"=>"failed",
        "message"=> $e->getMessage()
    ]);
}
    

?>