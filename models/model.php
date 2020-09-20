<?php
namespace app\models;
use app\services\DB;
abstract class Model
{
    abstract protected static function getTableName():string;
    /**
     * @return DB 
     */
    protected static function getDB()
    {
        return DB::getInstance();
    }

    public static function getOneGood($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $params = [':id' => $id];
        return static::getDB()->findObject($sql, static::class, $params);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return static::getDB()->findAllObject($sql, static::class);
    }

    public function insert()
    {
        $fields = [];
        $params = [];
        foreach ($this as $fieldName => $value) {
            if ($fieldName == 'id') {
                continue;
            }
            $fields[] = $fieldName;
            $params[":{$fieldName}"] = $value;
        }
        $sql = printf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::getTableName(),
            implode(',', $fields),
            implode(',', array_keys($params))
        );
        static::getDB()->execute($sql, $params);
        $this->id = static::getDB()->getLastId();
    }

    public function update()
    {
        $fields = [];
        $params = [];
        foreach ($this as $fieldName => $value) {
            $fields[] = $fieldName;
            $params[":{$fieldName}"] = $value;
        }  
        
        $sql = sprintf(
            "UPDATE %s SET %s = %s WHERE `id` = $this->id ",
            static::getTableName(),
            implode(',', $fields),
            implode(',', $params)
        );
        
        static::getDB()->execute($sql, $params);
        $this->id = static::getDB()->getLastId();
    }

    public function save()
    {
        if (empty($this->id)) {
            $this->insert();
            return;
        }
        $this->update();
    }

    public function delete()
    {
        $sql = sprintf("DELETE FROM %s WHERE `id` = $this->id",  static::getTableName());
        static::getDB()->execute($sql);
    }
}