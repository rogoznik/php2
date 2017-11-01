<?php

use app\services\Autoloader;


require_once '../config/main.php';
require_once '../services/Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$controllerName = $_GET['c'];
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

$controller = new $controllerClass();

$controller->run($actionName);