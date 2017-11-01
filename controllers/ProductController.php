<?php
namespace app\controllers;

class ProductController
{
    private $action;
    
    public function run($action)
    {
        $this->action = $action;
        $action = "action" . ucfirst($this->action);
        $this->$action();
    }
    
    
    public function actionCard()
    {
        echo "123123123";
    }
}

