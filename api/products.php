<?php 
session_start();

include_once __DIR__."./lib/conn.php";
include_once __DIR__."./lib/response_builder.php";
include_once __DIR__."./lib/request_builder.php";


$products  = SELECT("products",null, "1",null,$_GET["page"]??1);


respond("Fetched", $products);