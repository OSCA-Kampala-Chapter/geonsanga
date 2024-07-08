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
define('UGANDA', 'Uganda/');

/**
 * Composer
 */
require_once __DIR__ . '/vendor/autoload.php'; 

/*
* include Uganda Class files
*/
foreach (glob(UGANDA."*.php") as $ug):
  require_once $ug; 
endforeach;

use Steampixel\Route;
use Uganda\Uganda;

$uganda = new Uganda();

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