<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Steampixel\Route;
use Uganda\Exceptions\ParishNotFoundException;

$obj = new stdClass();

/**
 * Parish Particular operations
 */
// Get all parish details, without a space e.g. 
Route::add('/v1/parish/([a-z-0-9-]*)', function ($param) use($uganda, $obj) {

  $parish = insertSpaceBeforeUppercase($param);

  header('Content-Type: application/json');

  try {
    $parish_ = $uganda->parish($parish);
    $obj->count = 1;
    $obj->parish = $parish_;
  } catch (ParishNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all parish details, without a space e.g. 
Route::add('/v1/parish/([a-z-0-9-]*)/villages', function ($param) use($uganda, $obj) {

  $parish = insertSpaceBeforeUppercase($param);

  header('Content-Type: application/json');

  try {
    $villages = $uganda
                ->parish($parish)
                ->villages();

    $count = count($villages);

    $names = [];
    foreach($villages as $village):
    $names[] = $village->name;
    endforeach;
    $obj->count = $count;
    $obj->villages = $names;
  } catch (ParishNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');


