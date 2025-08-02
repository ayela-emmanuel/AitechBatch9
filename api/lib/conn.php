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
function SELECTONE(string $table, ?array $cols, string $where, ?array $values){
    global $connection;
    // SELECT * FROM `table` WHERE () LIMIT 10 OFFSET 10*page-1;
    $cols = empty($cols)|| $cols == null ? "*": implode(", ",$cols);
    $query = "SELECT $cols FROM `$table` WHERE $where";
    $stmt = $connection->prepare($query);
    if($stmt->execute($values)){
        return $stmt->get_result()->fetch_assoc();
    }
    return false;
    
}


function SELECT(string $table, ?array $cols, string $where, ?array $values, int $page = 1){
    global $connection;
    $page = $page<1 ? 1: $page;
    // SELECT * FROM `table` WHERE () LIMIT 10 OFFSET 10*page-1;
    $cols = empty($cols)|| $cols == null ? "*": implode(", ",$cols);
    $offset = ($page-1)*10;
    $query = "SELECT $cols FROM `$table` WHERE $where LIMIT 10 OFFSET $offset;";
    //echo $query;
    $stmt = $connection->prepare($query);
    if($stmt->execute($values)){
        $data = [ ];
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }
    return false;
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
