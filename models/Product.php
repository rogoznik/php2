<?php
namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $idBrand;
    
    public function __construct($id, $name, $description, $price, $idBrand)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->idBrand = $idBrand;
    }
    
    public function getTableName()
    {
        return "products";
    }
}

