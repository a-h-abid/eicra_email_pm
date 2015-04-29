<?php

// Set Datetime
date_default_timezone_set('Asia/Dacca');

// Start Session
session_cache_limiter(false);
session_start();

// Change Directory for easier access from root
chdir(dirname(__DIR__));

/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'vendor/autoload.php';

// Require ENV file
require '.env.php';

// Get config file then merge with env_mode file
$config = require 'config/config.php';
$config = array_merge($config, require 'config/config.'.APP_MODE.'.php');

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim($config);

// Set Base Path to Views
$app->view->setTemplatesDirectory('views');


// Set Dependency Containers
require_once('app/containers.php');

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
require_once('app/routes.php');


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
