<?php
namespace app\models;

class Categories extends Model
{
    public $id;
    public $name;
    
    public function __construct($id, $name)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
    }

    public function getTableName()
    {
        return "categories";
    }
}

