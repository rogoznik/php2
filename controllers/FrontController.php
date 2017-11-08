<?php

namespace app\controllers;


use app\services\Request;
use app\services\RequestNotMatchException;

class FrontController extends Controller
{
    private $controller;
    private $action;

    private $defaultController = "product";

    public function actionIndex()
    {
        $rm = new Request();

//        var_dump(ROOT_DIR . "controllers/" . ucfirst($this->controllerName) . "Controller.php");
        if (!file_exists(ROOT_DIR . "controllers/" . ucfirst($this->controllerName) . "Controller.php")) {
            echo "13123123123";
//            throw new RequestNotMatchException("Page not found");
        }
        $controllerName = $rm->getControllerName() ?: $this->defaultController;
        $this->action = $rm->getActionName();

        $this->controller = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

        $controller = new $this->controller(new \app\services\renderers\TemplateRenderer());
         $controller->run($this->action);

    }
}