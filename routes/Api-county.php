<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


use Steampixel\Route;
use Uganda\Exceptions\CountyNotFoundException;

$obj = new stdClass();

/**
 * County Particular operations
 */
// Get all County details
Route::add('/v1/county/([a-z-0-9-]*)', function ($county) use($uganda, $obj) {
  /**
   * @todo get the county without spaces and insert spaces before every uppercase letter
   */
  // echo "Hello county";
  echo urldecode($county);
  // header('Content-Type: application/json');

  // try {
  //   $county_ = $uganda->county($county);
    
  //   $obj->count = 1;
  //   $obj->county = $county_;
  // } catch (CountyNotFoundException $e) {
  //   $obj->error = "County Not Found";
  // }
  // echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

