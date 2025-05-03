<?php
/**
 * Garbage Collection System
 * Main entry point
 */

// Define base path
define('BASE_PATH', __DIR__);

// Load composer autoloader if exists
if (file_exists(BASE_PATH . '/vendor/autoload.php')) {
    require_once BASE_PATH . '/vendor/autoload.php';
}

// Load configuration
require_once BASE_PATH . '/app/config/config.php';

// Load core files
require_once BASE_PATH . '/app/core/Database.php';
require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/core/Model.php';

// Load helpers
require_once BASE_PATH . '/app/helpers/functions.php';
require_once BASE_PATH . '/app/helpers/ErrorHandler.php';

// Start session
session_start();

// Initialize router
$router = new Router();

// Define routes
$router->addRoute('GET', '/', 'UserController@index');
$router->addRoute('POST', '/login', 'AuthController@login');
$router->addRoute('GET', '/logout', 'AuthController@logout');
$router->addRoute('POST', '/register', 'UserController@register');
$router->addRoute('POST', '/company/register', 'CompanyController@register');

// Dispatch the request
$router->dispatch(); 