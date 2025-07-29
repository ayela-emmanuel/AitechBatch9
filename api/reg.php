<?php 
session_start();

include_once __DIR__."./lib/conn.php";
include_once __DIR__."./lib/response_builder.php";
include_once __DIR__."./lib/request_builder.php";

$data = get_post_data();
$email = strtolower($data["email"]);
$password = $data["password"];
$firstname = $data["firstname"];
$lastname = $data["lastname"];
$age = $data["age"];
$address = $data["address"];


if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    respond("The Email $email is not Valid!",null, 400);
}

// Validation



$clean_data = [
    "email"=>$email,
    "password"=>password_hash($password, PASSWORD_DEFAULT),
    "firstname"=>$firstname,
    "lastname"=>$lastname,
    "age"=>$age,
    "address"=>$address
];

$result = INSERT("users", $clean_data);

if($result){
    respond("Registered");
}else{
    respond("Unknown Error");
}





