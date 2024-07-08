<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use Steampixel\Route;
use Uganda\Exceptions\SubCountyNotFoundException;

$obj = new stdClass();

/**
 * County Particular operations
 */
// Get all subcounties details, without a space e.g. KiruTownCouncil
Route::add('/v1/subcounty/([a-z-0-9-]*)', function ($param) use($uganda, $obj) {

  $subcounty = insertSpaceBeforeUppercase($param);
  $subcounty_ = $uganda->subcounty($subcounty);

  header('Content-Type: application/json');

  try {
    $subcounty_ = $uganda->subcounty($subcounty);
    $obj->count = 1;
    $obj->county = $subcounty_;
  } catch (SubCountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');


