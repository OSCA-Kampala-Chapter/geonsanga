<?php
use Steampixel\Route;
$obj = new stdClass();

Route::add('/v1/ping', function () {
    global $uganda, $obj;
    header('Content-Type: application/json');
    $obj->status = 1;
    $obj->response = $uganda->districts();
    echo json_encode($obj, JSON_PRETTY_PRINT);
  },'POST');