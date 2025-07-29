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


function INSERT(string $table, array $kvp ){
    global $connection;
    $keys = implode(", ",array_keys($kvp));
    
    // ["A", "b","c"]
    // "A,b,c"
    $vals = [];
    foreach ($kvp as $data) {
        $vals[] = "?";
    }
    $vals = implode(", ",$vals);
    $query = "INSERT INTO `$table` ($keys) VALUES ($vals)";
    $stmt = $connection->prepare($query);
    
    if($stmt->execute(array_values($kvp))){
       return $stmt->affected_rows>0;
    }
    return false;
}


?>
