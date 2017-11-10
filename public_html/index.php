<?php

use app\controllers\FrontController;
use app\services\Autoloader;


require_once '../config/main.php';
require_once '../services/Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

(new FrontController())->run();