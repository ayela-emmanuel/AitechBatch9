<?php 
session_start();

include_once __DIR__."./lib/conn.php";
include_once __DIR__."./lib/response_builder.php";
include_once __DIR__."./lib/request_builder.php";


if(!isset($_GET["pid"])){
    respond("Failed to add to Cart",null,400);
}


if(!isset($_SESSION["user"])){
    respond("No User Logged in",null,401);
}

$res = INSERT("cart_items",[
    "userid"=> $_SESSION["user"]["id"], 
    "productid"=> $_GET["pid"],
    "qty"=> $_GET["qty"]??1,
    "var"=> $_GET["var"]??0,
]);
if($res){
    respond("Added");

}
respond("Failed to add to Cart",null,400);
