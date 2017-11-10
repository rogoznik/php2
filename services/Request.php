<?php

namespace app\services;

use app\exceptions\RequestNotMatchException;

class Request
{
    private $requestString;
    private $params;

    private $controllerName;
    private $actionName;

    private $patterns = [
        "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui"
    ];

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    private function parseRequest()
    {
        foreach ($this->patterns as $pattern) {
            if (preg_match_all($pattern, $this->requestString, $matches)) {
                $this->controllerName = $matches['controller'][0];
                if (!file_exists(ROOT_DIR . "controllers/" . ucfirst($this->controllerName) . "Controller.php")) {
                    throw new RequestNotMatchException("Page not found");
                }
                $this->actionName = $matches['action'][0];
                if (!method_exists(CONTROLLERS_NAMESPACE . ucfirst($this->controllerName) . "Controller",
                    "action" . ucfirst($this->actionName))) {
                    throw new RequestNotMatchException("Page not found");
                }
//                if ($matches['params'][0] == '' || $matches['params'][0] == null) {
//                    throw new RequestNotMatchException("asd");
//                }
                foreach (explode("&", $matches['params'][0]) as $param) {
                    $p = explode("=", $param);
                    $this->params[$p[0]] = $p[1];
                }
//                if ($this->params[0] == '') {
//                    throw new RequestNotMatchException("Page not found");
//                }

                return;
            }
        }
    }


    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }
}