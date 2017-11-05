<?php
namespace app\controllers;

class Controller
{
    private $action;
    private $defaultAction = "index";
    private $layout = "main";
    private $useLayout = true;
    
    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $action = "action" . ucfirst($this->action);
        $this->$action();
    }
    
    public function render($template, $params)
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}",
                ['content' => $this->renderTemplate($template, $params)]
            );
        } else {
            return $this->renderTemplate($template, $params);
        }
    }
    
    public function renderTemplate($template, $params)
    {
        ob_start();
        if (strpos($template, 'layouts/') === 0) {
            extract($params);;
            include ROOT_DIR . "views/{$template}.php";
        } else if (strpos($template, 'layouts/') === false) {
            $className = explode('\\', get_called_class())[count(explode('\\', get_called_class()))-1];
            $controllerName = strtolower(explode('Controller', $className)[0]);
            if (is_array($params['product'])) {
                foreach ($params['product'] as $param) {
                    extract(['product' => $param]);
                    include ROOT_DIR . "views/{$controllerName}/{$template}.php";
                }
            } else {
                extract($params);
                include ROOT_DIR . "views/{$controllerName}/{$template}.php";
            }
        }

        return ob_get_clean();

    }
}

