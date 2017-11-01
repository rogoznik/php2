<?php
namespace app\models;

class Category extends Model
{
    public $id;
    public $name;
    
    public function __construct0(){}
    
    public function __construct($id = null, $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getTableName()
    {
        return "categories";
    }
}

