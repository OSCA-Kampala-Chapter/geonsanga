<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


use Steampixel\Route;
use Uganda\Exceptions\CountyNotFoundException;
use Uganda\Exceptions\DistrictNotFoundException;
use Uganda\Exceptions\ParishNotFoundException;
use Uganda\Exceptions\SubCountyNotFoundException;
use Uganda\Exceptions\VillageNotFoundException;

$obj = new stdClass();

Route::add('/v1/ping', function () use($uganda, $obj) {
  echo "Hello World";
},'GET');

// Get all districts
Route::add('/v1/districts', function () use($uganda, $obj) {
  header('Content-Type: application/json');

  try {
    $districts = $uganda->districts();
    $count = count($districts);
    
    $names = [];
    foreach($districts as $dist):
      $names[] = $dist->name;
    endforeach;
    $obj->count = $count;
    $obj->districts = $names;
  } catch (DistrictNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all Counties
Route::add('/v1/counties', function () use($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $counties = $uganda->counties();
    $count = count($counties);
    
    $names = [];
    foreach($counties as $county):
      $names[] = $county->name;
    endforeach;
    $obj->count = $count;
    $obj->counties = $names;
  } catch (CountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all Sub Counties
Route::add('/v1/subcounties', function () use($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $subcounties = $uganda->subcounties();
    $count = count($subcounties);
    
    $names = [];
    foreach($subcounties as $subcounty):
      $names[] = $subcounty->name;
    endforeach;
    $obj->count = $count;
    $obj->subcounties = $names;
  } catch (SubCountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }
  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all Parishes
Route::add('/v1/parishes', function () use($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $parishes = $uganda->parishes();
    $count = count($parishes);
    
    $names = [];
    foreach($parishes as $parish):
      $names[] = $parish->name;
    endforeach;
    $obj->count = $count;
    $obj->parishes = $names;
  } catch (ParishNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all Villages
Route::add('/v1/villages', function () use($uganda, $obj) {
  header('Content-Type: application/json');
  try {
    $villages = $uganda->villages();
    $count = count($villages);
    
    $names = [];
    foreach($villages as $parish):
      $names[] = $parish->name;
    endforeach;
    $obj->count = $count;
    $obj->villages = $names;
  } catch (VillageNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all counties in a particular district
// Route::add('/v1/([a-z-0-9-]*)/counties', function ($district) use($uganda) {
//   header('Content-Type: application/json');
//   // echo $district;
//   $counties = $uganda
//                 ->district($district)
//                 ->counties();
//   echo json_encode($counties, JSON_PRETTY_PRINT);
// },'GET');
