<?php
namespace app\models;

class Brand extends Model
{
    public $id;
    public $name;
    public $idCategory;
    
    public function __construct($id = null, $name = null, $idCategory = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->idCategory = $idCategory;
    }

    public static function getTableName()
    {
        return "brands";
    }
}

