<?php
namespace app\controllers;

use app\models\DataGetter;
use app\models\repositories\ProductRepository;
use app\services\Request;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        $templateName = $this->controllerName . "/catalog";
        echo $this->render($templateName, ['product' => $products]);
    }
    
    public function actionCard()
    {
        $id = (new Request())->getParams()['id'];
        $product = (new ProductRepository())->getOne($id);
        $templateName = $this->controllerName . "/card";
        echo $this->render($templateName, ['product' => $product]);
    }
}

