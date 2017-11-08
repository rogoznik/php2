<?php

use app\services\Autoloader;


require_once '../config/main.php';
require_once '../services/Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);


try {
    (new \app\controllers\FrontController())->run();
} catch (\app\services\RequestNotMatchException $e) {
    header("Location: /error/404");
}
