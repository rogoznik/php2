<?php

namespace app\models\repositories;


use app\services\Db;

abstract class Repository
{
    protected $tableName;
    protected $entityClass;

    private $db;

    /**
     * DataGetter constructor.
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }


    public function getOne($id)
    {
        return $this->db->fetchObject(
            "SELECT * FROM {$this->tableName} WHERE id = :id",
            ['id' => $id],
            $this->entityClass
        );
    }

    public  function getAll()
    {
        return $this->db->fetchAllAsArrayOfObject(
            "SELECT * FROM {$this->tableName}",
            [],
            $this->entityClass
        );
    }

    public function update(DataModel $entity){}

    public function create(DataModel $entity){}

    public function delete(DataModel $entity){}


//    public function create($values)
//    {
//        $tableName = static::getTableName();
//        $sql = "INSERT INTO {$tableName} (";
//        $val = "VALUES (";
//        $i = 0;
//        foreach ($values as $key => $value) {
//            $sql .= $key;
//            $val .= "'{$value}'";
//            if ($i < count($values) - 1) {
//                $sql .= ", ";
//                $val .= ", ";
//            } else {
//                $sql .= ") ";
//                $val .= ")";
//            }
//            ++$i;
//        }
//        $sql .= $val;
//        return $this->db->execute($sql);
//    }
//
//    public function update($values, $params)
//    {
//        $tableName = static::getTableName();
//        $sql = "UPDATE {$tableName} SET ";
//        $i = 0;
//        foreach ($values as $key => $value) {
//            $sql .= "{$key} = '{$value}'";
//            if ($i < count($values) - 1) {
//                $sql .= ", ";
//            }
//            ++$i;
//        }
//        $sql .= " WHERE id = :id";
//        return $this->db->execute($sql, $params);
//    }
//
//    public function delete($params)
//    {
//        $tableName = static::getTableName();
//        return $this->db->execute("DELETE FROM {$tableName} WHERE id = :id", $params);
//    }

    private static function getDb()
    {
        return Db::getInstance();
    }
}