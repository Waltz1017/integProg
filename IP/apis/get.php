<?php 
try {
    $sql="SELECT * FROM student";
    $stmt=$konek->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount()==0){
        http_response_code(400);
        echo json_encode([
        "status" => "success",
        "message" => "No records"
    ]);
    }
    else {
         http_response_code(200);
        echo json_encode($result);
    }
}
catch(PDOExcemption $e) {
    http_response_code(400);
    echo json_encode([
        "status" => "failed",
        "message" => $e->getMessage()
    ]);
}


?>