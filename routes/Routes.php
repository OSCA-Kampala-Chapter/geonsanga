<?php
use Steampixel\Route; 

/**
 * Example View (Shows the index page)
 * PHP version 7.0
 */

Route::add('/([a-z-0-9-]*)', function () {
    include 'views/index.html';
  });

Route::add('/test-readme)', function () {
  include 'README.md';
});