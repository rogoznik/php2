<?php
namespace app\services;

require_once '../config/main.php';

class Autoloader
{
    function loadClass($className) {
        $className = str_replace('app\\', '/', $className);
        $className = str_replace('\\', '/', $className);
        $fileName = "../{$className}.php";
        if (file_exists($fileName)) {
            require_once($fileName);
        }
    }
}

