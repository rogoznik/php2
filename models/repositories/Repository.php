<?php

namespace app\models\repositories;


use app\models\DataEntity;
use app\services\Db;

abstract class Repository
{
    protected $tableName;
    protected $entityClass;

    private $db;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }


    public function getOne($id)
    {
        return $this->db->fetchObject(
            "SELECT * FROM {$this->tableName} WHERE id = :id",
            $this->entityClass,
            ['id' => $id]
        );
    }

    public  function getAll()
    {
        return $this->db->fetchAllAsArrayOfObject(
            "SELECT * FROM {$this->tableName}",
            $this->entityClass
        );
    }

    public function update(DataEntity $entity){
        $values = get_object_vars($entity);
        $params =[];
        $sql = "UPDATE {$this->tableName} SET ";
        $i = 0;
        foreach ($values as $key => $value) {
            if ($key == 'id') {
                $params = ['id' => $values['id']];
            } else {
                $sql .= "{$key} = '{$value}'";
                if ($i < count($values) - 1) {
                    $sql .= ", ";
                }
            }
            ++$i;
        }
        $sql .= " WHERE id = :id";
        return $this->db->execute($sql, $params);
    }

    public function create(DataEntity $entity){
        $values = get_object_vars($entity);
        $sql = "INSERT INTO {$this->tableName} (";
        $val = "VALUES (";
        $i = 0;
        foreach ($values as $key => $value) {
            if ($key != 'id') {
                $sql .= $key;
                $val .= "'{$value}'";
                if ($i < count($values) - 1) {
                    $sql .= ", ";
                    $val .= ", ";
                } else {
                    $sql .= ") ";
                    $val .= ")";
                }
            }
            ++$i;
        }
        $sql .= $val;
        return $this->db->execute($sql);
    }

    public function delete(DataEntity $entity){
        $params = get_object_vars($entity);
        return $this->db->execute("DELETE FROM {$this->tableName} WHERE id = :id", $params);
    }

    private static function getDb()
    {
        return Db::getInstance();
    }
}