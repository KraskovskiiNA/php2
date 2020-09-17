<?php
namespace app\models;
use app\services\DB;
abstract class Model
{
    abstract protected function getTableName():string;
    /**
     * @return DB 
     */
    protected function getDB()
    {
        return DB::getInstance();
    }

    public function getOneGood($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $params = [':id' => $id];
        return $this->getDB()->find($sql, $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->getDB()->findAll($sql);
    }

    public function insert($data)
    {
        $tableName = $this->getTableName();
        $insert = $this->getDB()->prepare("INSERT INTO {$tableName} (a, b, c) values (?, ?, ?)");
        $insert->execute($data);
    }

    public function update($id)
    {
        $tableName = $this->getTableName();
        $update = $this->getDB()->prepare('UPDATE {$tableName} SET name = :name WHERE id = :id');
    }

    public function save()
    {
        if (empty($this->id)) {
            return $this->insert();
        }
        return $this->update();
    }

    public function delete($id)
    {
        $delete = $this->getDB()->prepare('DELETE FROM {$tableName} WHERE id = :id');
    }
}