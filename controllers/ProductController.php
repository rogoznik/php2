<?php
namespace app\controllers;

use app\models\DataGetter;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        echo $this->render("card", ['product' => $products]);
    }
    
    public function actionCard()
    {
        $id = $_GET['id'];
        $product = (new ProductRepository())->getOne($id);
        echo $this->render("card", ['product' => $product]);
    }
}

