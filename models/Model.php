<?php
namespace app\models;

use app\services\Db;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->getDb();
    }

    public function getOne($id)
    {
        return $this->db->queryOne("SELECT * FROM {$this->getTableName()} WHERE id = :id", ['id' => $id]);
    }

    public function getAll()
    {
        return $this->db->queryAll("SELECT * FROM {$this->getTableName()}");
    }

    private function getDb()
    {
        return Db::getInstance();
    }

    abstract public function getTableName();

    public function create($values)
    {
        $sql = "INSERT INTO {$this->getTableName()} (";
        $val = "VALUES (";
        $i = 0;
        foreach ($values as $key => $value) {
            $sql .= $key;
            $val .= "'{$value}'";
            if ($i < count($values) - 1) {
                $sql .= ", ";
                $val .= ", ";
            } else {
                $sql .= ") ";
                $val .= ")";
            }
            ++$i;
        }
        $sql .= $val;
        return $this->db->execute($sql);
    }
    
    public function update($values, $params)
    {
        $sql = "UPDATE {$this->getTableName()} SET ";
        $i = 0;
        foreach ($values as $key => $value) {
            $sql .= "{$key} = '{$value}'";
            if ($i < count($values) - 1) {
                $sql .= ", ";
            }
            ++$i;
        }
        $sql .= " WHERE id = :id";
        return $this->db->execute($sql, $params);
    }
    
    public function delete($params)
    {
        return $this->db->execute("DELETE FROM {$this->getTableName()} WHERE id = :id", $params);
    }
    
    public function select($params)
    {
        return $this->db->execute("SELECT * FROM {$this->getTableName()} WHERE id = :id", $params);
    }
    
}

