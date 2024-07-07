<?php
use Steampixel\Route;
use Uganda\Exceptions\DistrictNotFoundException;

$obj = new stdClass();

/**
 * District Particular operations
 */
// Get all district details
Route::add('/v1/district/([a-z-0-9-]*)', function ($district) use($uganda, $obj) {
  header('Content-Type: application/json');

  try {
    $dist = $uganda->district($district);
    
    $obj->count = 1;
    $obj->district = $dist;
  } catch (DistrictNotFoundException $e) {
    $obj->error = $e->getMessage();
  }
  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all counties in a particular district
Route::add('/v1/([a-z-0-9-]*)/counties', function ($district) use($uganda, $obj) {
  header('Content-Type: application/json');

  try {
    $counties = $uganda
                ->district($district)
                ->counties();

    $count = count($counties);
    
    $names = [];
    foreach($counties as $county):
      $names[] = $county->name;
    endforeach;
    $obj->count = $count;
    $obj->counties = $names;
  } catch (DistrictNotFoundException $e) {
    $obj->error = $e->getMessage();
  }
  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all subcounties in a particular district
Route::add('/v1/([a-z-0-9-]*)/subcounties', function ($district) use($uganda, $obj) {
  header('Content-Type: application/json');

  try {
    $subcounties = $uganda
                ->district($district)
                ->subcounties();

    $count = count($subcounties);
    
    $names = [];
    foreach($subcounties as $subcounty):
      $names[] = $subcounty->name;
    endforeach;
    $obj->count = $count;
    $obj->subcounties = $names;
  } catch (DistrictNotFoundException $e) {
    $obj->error = $e->getMessage();
  }
  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all parishes in a particular district
Route::add('/v1/([a-z-0-9-]*)/parishes', function ($district) use($uganda, $obj) {
  header('Content-Type: application/json');

  try {
    $parishes = $uganda
                ->district($district)
                ->parishes();

    $count = count($parishes);
    
    $names = [];
    foreach($parishes as $parish):
      $names[] = $parish->name;
    endforeach;
    $obj->count = $count;
    $obj->parishes = $names;
  } catch (DistrictNotFoundException $e) {
    $obj->error = $e->getMessage();
  }
  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all villages in a particular district
Route::add('/v1/([a-z-0-9-]*)/villages', function ($district) use($uganda, $obj) {
  header('Content-Type: application/json');

  try {
    $villages = $uganda
                ->district($district)
                ->villages();

    $count = count($villages);
    
    $names = [];
    foreach($villages as $village):
      $names[] = $village->name;
    endforeach;
    $obj->count = $count;
    $obj->villages = $names;
  } catch (DistrictNotFoundException $e) {
    $obj->error = $e->getMessage();
  }
  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');
