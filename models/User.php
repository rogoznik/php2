<?php
namespace app\models;


class User extends Model
{
    public $id;
    public $login;
    public $password;
    public $email;
    
    public function __construct($id = null, $login = null, $password = null, $email = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }

    
    public static function getTableName()
    {
        return "users";
    }



}

