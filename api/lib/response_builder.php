<?php

/**
 * Responds with message code and data
 */

function respond(string $message, $data = null, int $code = 200 ){

    
    $res = [
        "message" => $message,
        "code" => $code,
        "data" => $data,

    ];
    header("content-type: application/json");
    http_response_code($code);
    echo json_encode($res);
    exit();
}


?>