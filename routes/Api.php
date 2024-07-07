<?php
use Steampixel\Route;
$obj = new stdClass();

Route::add('/v1/ping', function () use($uganda, $obj) {
  header('Content-Type: application/json');
  $obj->status = 1;
  $obj->response = $uganda->districts();
  echo json_encode($obj, JSON_PRETTY_PRINT);
},'POST');

// Get all districts
Route::add('/v1/districts', function () use($uganda) {
  header('Content-Type: application/json');
  echo json_encode($uganda->districts(), JSON_PRETTY_PRINT);
},'POST');

// Get all Counties
Route::add('/v1/counties', function () use($uganda) {
  header('Content-Type: application/json');
  echo json_encode($uganda->counties()->_counties, JSON_PRETTY_PRINT);
},'POST');

// Get all Sub Counties
Route::add('/v1/subcounties', function () use($uganda) {
  header('Content-Type: application/json');
  echo json_encode($uganda->sub_counties()->_sub_counties, JSON_PRETTY_PRINT);
},'POST');

// Get all Parishes
Route::add('/v1/parishes', function () use($uganda) {
  header('Content-Type: application/json');
  echo json_encode($uganda->parishes()->_parishes, JSON_PRETTY_PRINT);
},'POST');

// Get all Villages
Route::add('/v1/villages', function () use($uganda) {
  header('Content-Type: application/json');
  echo json_encode($uganda->villages()->_villages, JSON_PRETTY_PRINT);
},'POST');

// Get all counties in a particular district
// Route::add('/v1/([a-z-0-9-]*)/counties', function ($district) use($uganda) {
//   header('Content-Type: application/json');
//   // echo $district;
//   $counties = $uganda
//                 ->district($district)
//                 ->counties();
//   echo json_encode($counties, JSON_PRETTY_PRINT);
// },'GET');
