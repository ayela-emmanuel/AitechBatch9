<?php 
session_start();

include_once __DIR__."./lib/conn.php";
include_once __DIR__."./lib/response_builder.php";
include_once __DIR__."./lib/request_builder.php";

$data = get_post_data();
$email = strtolower($data["email"]);
$password = $data["password"];

//Validate
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    respond("The Email $email is not Valid!",null, 400);
}


// get user
$query = "SELECT * from `users` WHERE `email` = ?";


$stmt = $connection->prepare($query);
if(!$stmt->execute([$email])){
    respond("Error",null, 500);
}


$result = $stmt->get_result();
$user = $result->fetch_assoc();


if($user != null && password_verify($password,$user["password"])){
    $data = [
        $user["firstname"],
        $user["lastname"],
        $user["email"],
        $user["id"],
    ];
    $_SESSION["user"] = $data;
    respond("Loggedin", $data);
    
}else{
    respond("Wrong Password",null, 401);

}









?>