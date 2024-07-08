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

// Get all subcounties in a particular county e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)/subcounties', function ($param) use($uganda, $obj) {

  $county = insertSpaceBeforeUppercase($param);
  
  header('Content-Type: application/json');
  try {
    $subcounties_ = $uganda
              ->county($county)
              ->subcounties();

    $count = count($subcounties_);

    $names = [];
    foreach($subcounties_ as $subcounty):
      $names[] = $subcounty->name;
    endforeach;
    $obj->count = $count;
    $obj->subcounties = $names;
  } catch (CountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all parsihes in a particular county e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)/parishes', function ($param) use($uganda, $obj) {

  $county = insertSpaceBeforeUppercase($param);
  
  header('Content-Type: application/json');
  try {
    $parishes = $uganda
              ->county($county)
              ->parishes();

    $count = count($parishes);

    $names = [];
    foreach($parishes as $parish):
      $names[] = $parish->name;
    endforeach;
    $obj->count = $count;
    $obj->parishes = $names;
  } catch (CountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all parsihes in a particular county e.g. LabworCounty
Route::add('/v1/county/([a-z-0-9-]*)/villages', function ($param) use($uganda, $obj) {

  $county = insertSpaceBeforeUppercase($param);
  
  header('Content-Type: application/json');
  try {
    $villages = $uganda
              ->county($county)
              ->villages();

    $count = count($villages);

    $names = [];
    foreach($villages as $village):
      $names[] = $village->name;
    endforeach;
    $obj->count = $count;
    $obj->villages = $names;
  } catch (CountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

