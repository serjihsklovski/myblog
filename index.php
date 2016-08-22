<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once ROOT . '/components/application.php';

$config = require __DIR__ . '/config/web.php';

(new Application($config))->run();
