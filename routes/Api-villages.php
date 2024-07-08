<?php
use Steampixel\Route;
use Uganda\Exceptions\VillageNotFoundException;

$obj = new stdClass();

/**
 * Village Particular operations
 */
// Get all village details, without a space e.g. 
Route::add('/v1/village/([a-z-0-9-]*)', function ($param) use($uganda, $obj) {

  $village = insertSpaceBeforeUppercase($param);

  header('Content-Type: application/json');

  try {
    $village_ = $uganda->village($village);
    $obj->count = 1;
    $obj->village = $village_;
  } catch (VillageNotFoundException $e) {
    $obj->error = new VillageNotFoundException(sprintf("You're sailing in unchartered waters, %s village not found", $village));
  }

  echo json_encode($obj, JSON_PRETTY_PRINT);
},'GET');


