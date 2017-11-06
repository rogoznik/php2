<?php
namespace app\services;

class Db
{
    private $conn = null;
    
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'php_user',
        'password' => 'pass',
        'database' => 'geekshop',
        'charset' => 'UTF8'
    ];
    
    private static $instance = null;
    
        
    private function __construct(){}
    
    private function __clone(){}
    
    private function __wakeup(){}
    
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }
    
    private function getConnection()
    {
        if (is_null($this->conn)){
            $this->conn = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
    }
    
    private function prepareDsnString()
    {
        return sprintf('%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }
    
    private function query($sql, $params)
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        
        return $PDOStatement;
    }
    
    public function execute($sql, $params = [])
    {
        $this->query($sql, $params);
        return true;
    }
    
    public function fetchAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function fetchOne($sql, $params = [])
    {
        return $this->fetchAll($sql, $params)[0];
    }
    
    public function fetchObject($sql, $class, $params = [])
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetch();
    }
    
    public function fetchAllAsArrayOfObject($sql, $class, $params = [])
    {
        $smtp = $this->query($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetchAll();
    }
}

