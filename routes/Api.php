<?php
use Steampixel\Route;
use Uganda\Uganda;
$obj = new stdClass();


// $uganda = new Uganda();
/**
 * Example API route: login a user 
 * endpoint : http://localhost/v1/user/login
 */
// Route::add('/v1/user/login', function () {
//     header('Content-Type: application/json');
//     return login_user();
// }, 'POST');

Route::add('/v1/ping', function () {
    global $uganda, $obj;
    header('Content-Type: application/json');
    $obj->status = 1;
    $obj->response = "Geonsanga Matta Konko 💪🏽";
    echo json_encode($obj);
  },'GET');