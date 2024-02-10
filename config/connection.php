<?php

/**
 * root
 */
$root = $_SERVER["DOCUMENT_ROOT"]. "/";
/**
 * Composer
 */
require_once $root  . '/vendor/autoload.php';

use Ahc\Env\Loader;
(new Loader)->load($root .'.env'); 
use Ahc\Env\Retriever;

/**
 * Error and Exception handling
 */
if(Retriever::getEnv("APP_DEBUG")):
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
endif;

// DB connection would reside there, but I don't think we'll use any

?>