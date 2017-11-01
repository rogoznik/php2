<?php

use app\services\Autoloader;
use app\models\User;


require_once '../services/Autoloader.php';

spl_autoload_register([new Autoloader(), 'loadClass']);

$user = new User(null, null, null, null);


