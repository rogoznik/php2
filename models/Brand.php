<?php
namespace app\models;

class Brand extends Model
{
    public $id;
    public $name;
    public $idCategory;

    public function __construct($id, $name, $idCategory)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->idCategory = $idCategory;
    }

    public function getTableName()
    {
        return "brands";
    }
}

