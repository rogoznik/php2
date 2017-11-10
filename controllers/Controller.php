<?php
namespace app\controllers;



use app\services\renderers\IRender;
use app\services\renderers\TemplateRenderer;
use app\services\RequestNotMatchException;

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
     * @param IRender|null $renderer
     */
    public function __construct(IRender $renderer = null)
    {
        $this->renderer = $renderer;
        $className = explode('\\', get_called_class())[count(explode('\\', get_called_class()))-1];
        $this->controllerName = strtolower(explode('Controller', $className)[0]);
    }


    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $realAction = "action" . ucfirst($this->action);
//        if (!method_exists(get_called_class(), $realAction)) {
//            throw new RequestNotMatchException("Page not found");
//        }
        $this->$realAction();
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

