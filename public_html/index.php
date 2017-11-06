<?php

use app\services\Autoloader;


require_once '../config/main.php';
require_once '../services/Autoloader.php';
require_once '../vendor/autoload.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: "product";
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

$controller = new $controllerClass(new \app\services\renderers\TwigRenderer());

$controller->run($actionName);