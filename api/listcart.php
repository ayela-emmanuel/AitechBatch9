<?php
session_start();

include_once __DIR__."./lib/conn.php";
include_once __DIR__."./lib/response_builder.php";
include_once __DIR__."./lib/request_builder.php";

if(!isset($_SESSION["user"])){
    respond("No User Logged in",null,401);
}


$query = "SELECT *,`cart_items`.`qty` as added_qty from `cart_items` JOIN `products` ON `products`.`id` = `cart_items`.`productid` WHERE  `cart_items`.`userid` = ?"; 


$stmt = $connection->prepare($query);
if(!$stmt->execute([$_SESSION["user"]["id"]])){
    respond("Error",null, 500);
}


$result = $stmt->get_result();
$data = [];
while($row = $result->fetch_assoc()){
    $data[] = $row;
}

respond("",$data);




