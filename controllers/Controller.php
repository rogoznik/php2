<?php
namespace app\controllers;



use app\services\renderers\IRender;
use app\services\renderers\TemplateRenderer;

class Controller
{
    private $action;
    private $defaultAction = "index";
    private $layout = "main";
    private $useLayout = true;
    protected $controllerName;


    /**
     * @var TemplateRenderer
     */
    private $renderer = null;

    /**
     * Controller constructor.
     */
    public function __construct(IRender $renderer)
    {
        $this->renderer = $renderer;
        $className = explode('\\', get_called_class())[count(explode('\\', get_called_class()))-1];
        $this->controllerName = strtolower(explode('Controller', $className)[0]);
    }


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
        return $this->renderer->render($template, $params);
    }
}

