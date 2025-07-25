<?php

function get_post_data(){
    $data = file_get_contents("php://input");
    $data = json_decode($data, true);
    return $data;
}


?>