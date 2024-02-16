<?php
/**
 * Routing Gateway 
 * PHP version 7.0
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header_remove("X-Powered-By");
define('ROUTES', "routes/");
define('BASEPATH', "api/"); 

/**
 * Composer
 */
require_once __DIR__ . '/vendor/autoload.php'; 

use Steampixel\Route;
use Uganda\Geo;

$uganda = new Geo();

/**
 * validator
*/
use Rakit\Validation\Validator;
$validator = new Validator;

/**
 * validate paths
*/
$path = __DIR__ ."/config/";  
include $path."connection.php";

/*
* include api files
*/
foreach (glob(BASEPATH."*.php") as $api):
  include $api; 
endforeach;

/*
* json payload
 */
$payload = json_decode(file_get_contents('php://input'), true); 
    
/**
 * include all routes
*/
foreach (glob(ROUTES."*.php") as $routes):
  include $routes; 
endforeach; 

/**
 * Routing
 */
Route::run('/');

?>