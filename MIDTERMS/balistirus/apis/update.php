<?php 
$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? null;
$password = $data['password'] ?? null;
$program = $data['program'] ?? null;

if(empty($email) || empty($password) || empty($program)){
    http_response_code(400);
    echo json_encode([
        "status" => "failed",
        "message" => "Missing something"
    ]);
    exit();
}
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    http_response_code(400);
    echo json_encode([
        "status" => "failed",
        "message" => "Invalid email"
    ]);
    exit();
} 
if(strlen($password) < 8){
        http_response_code(400);
        echo json_encode([
        "status" => "failed",
        "message" => "Password must be 8 characters long."
        ]);
            exit();
    }
try{
    $hastPassword=password_hash($password, PASSWORD_DEFAULT);
    $sql="UPDATE student SET email=COALESCE(?, email),
    password=COALESCE(?, password), program=COALESCE(?,program)
    WHERE id=?";
    $stmt=$konek->prepare($sql);
    $stmt->execute([
        $email,$password,$program,$id
    ]);
    if($stmt->rowCount()==0){
        echo json_encode([
            "status"=>"failed",
            "message"=>"No record found"
        ]);
    }
    else {
        echo json_encode([
            "status"=>"success",
            "message"=>"Account updated"
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