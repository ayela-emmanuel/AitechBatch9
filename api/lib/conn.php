<?php
include_once __DIR__."./response_builder.php";

$connection;

try {
    $connection = new mysqli("localhost","root", "","esharp");

    if($connection->errno){
        respond("Service Unavailable",null, 500);
    }
}catch (mysqli_sql_exception $e){
    respond("Service Unavailable",null, 500);

}



?>
