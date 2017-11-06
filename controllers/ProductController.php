<?php
namespace app\controllers;

use app\models\DataGetter;
use app\models\repositories\ProductRepository;

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
        $id = $_GET['id'];
        $product = (new ProductRepository())->getOne($id);
        $templateName = $this->controllerName . "/card";
        echo $this->render($templateName, ['product' => $product]);
    }
}

