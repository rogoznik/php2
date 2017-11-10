<?php

namespace app\controllers;


use app\services\renderers\TemplateRenderer;
use app\services\Request;
use app\exceptions\RequestNotMatchException;

class FrontController extends Controller
{
    private $controller;
    private $action;

    private $defaultController = "product";

    public function actionIndex()
    {
        try {
            $rm = new Request();
        } catch (RequestNotMatchException $e) {
            header("Location: /error/404");
            exit;
        }

        $controllerName = $rm->getControllerName() ?: $this->defaultController;
        $this->action = $rm->getActionName();

        $this->controller = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

        $controller = new $this->controller(new TemplateRenderer());
        $controller->run($this->action);

    }
}