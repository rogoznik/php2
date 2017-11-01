<?php
namespace app\models;

use app\services\Db;

abstract class Model
{
    public static function getOne($id)
    {
        $tableName = static::getTableName();
        return static::getDb()->fetchObject(
            "SELECT * FROM {$tableName} WHERE id = :id",
            ['id' => $id],
            get_called_class()
        );
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        return static::getDb()->fetchAllAsArrayOfObject(
            "SELECT * FROM {$tableName}",
            [],
            get_called_class()
        );
    }

    private static function getDb()
    {
        return Db::getInstance();
    }

    abstract public static function getTableName();

    public function create($values)
    {
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} (";
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
        $tableName = static::getTableName();
        $sql = "UPDATE {$tableName} SET ";
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
        $tableName = static::getTableName();
        return $this->db->execute("DELETE FROM {$tableName} WHERE id = :id", $params);
    }
    
}

