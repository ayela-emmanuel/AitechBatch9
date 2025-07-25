<?php 
include_once __DIR__."./lib/conn.php";


$firstname = 'Danny';
$id = "11 OR `id` < 50";

$stmt = $connection->prepare("
    SELECT * FROM `users` WHERE  `id`= 4;
");

$r = $stmt -> execute();
if($r){
    //Get Result from stmt
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    header("content-type: application/json");
    echo json_encode($data);


}else{
    echo "Exec Failed!";
}


?>