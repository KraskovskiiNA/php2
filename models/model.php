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
        $sql = sprintf(
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
        // $params = [];
        // foreach ($this as $fieldName => $value) {
        //     $params[] = "`{$fieldName}`" . ' = ' . "'{$value}'";
        // }  
    
        // $sql = sprintf(
        //     "UPDATE %s SET %s WHERE %s .`id` = $this->id ",
        //     static::getTableName(),
        //     implode(',', $params),
        //     static::getTableName()
        // );
        
        // static::getDB()->execute($sql, $params);
        // $this->id = static::getDB()->getLastId();
        $params = [];
        $fields = [];
        foreach ($this as $fieldName => $value) {
            $params[":$fieldName"] = $value;
            if ($fieldName == 'id') {
                continue;
            }
            $fields[] = "{$fieldName} = :{$fieldName}";
        }
        $sql = sprintf("UPDATE %s SET %s WHERE id = :id", static::getTableName(), implode(',', $fields));
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