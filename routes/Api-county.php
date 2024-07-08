<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Steampixel\Route;
use Uganda\Exceptions\CountyNotFoundException;

$obj = new stdClass();

/**
 * County Particular operations
 */
// Get all County details, without a space e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)', function ($param) use($uganda, $obj) {

  $county = insertSpaceBeforeUppercase($param);
  $county_ = $uganda->county($county);

  header('Content-Type: application/json');

  try {
    $county_ = $uganda->county($county);
    $obj->count = 1;
    $obj->county = $county_;
  } catch (CountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

