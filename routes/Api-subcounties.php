<?php
use Steampixel\Route;
use Uganda\Exceptions\SubCountyNotFoundException;

$obj = new stdClass();

/**
 * Subcounty Particular operations
 */
// Get all subcounties details, without a space e.g. Abim
Route::add('/v1/subcounty/([a-z-0-9-]*)', function ($param) use($uganda, $obj) {

  $subcounty = insertSpaceBeforeUppercase($param);

  header('Content-Type: application/json');

  try {
    $subcounty_ = $uganda->subcounty($subcounty);
    $obj->count = 1;
    $obj->subcounty = $subcounty_;
  } catch (SubCountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all parishes in a subcounty, without a space e.g. Abim
Route::add('/v1/subcounty/([a-z-0-9-]*)/parishes', function ($param) use($uganda, $obj) {

  $subcounty = insertSpaceBeforeUppercase($param);

  header('Content-Type: application/json');

  try {
    $parishes = $uganda
                  ->subcounty($subcounty)
                  ->parishes();
    $count = count($parishes);

    $names = [];
    foreach($parishes as $parish):
      $names[] = $parish->name;
    endforeach;

    $obj->count = $count;
    $obj->parishes = $names;
  } catch (SubCountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');

// Get all villages in a subcounty, without a space e.g. Abim
Route::add('/v1/subcounty/([a-z-0-9-]*)/villages', function ($param) use($uganda, $obj) {

  $subcounty = insertSpaceBeforeUppercase($param);

  header('Content-Type: application/json');

  try {
    $villages = $uganda
                  ->subcounty($subcounty)
                  ->villages();
    $count = count($villages);

    $names = [];
    foreach($villages as $village):
      $names[] = $village->name;
    endforeach;

    $obj->count = $count;
    $obj->villages = $names;
  } catch (SubCountyNotFoundException $e) {
    $obj->error = $e->getMessage();
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');


