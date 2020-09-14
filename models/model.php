<?php
abstract class Model
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getOneGood($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = " . $id;
        return $this->db->find($sql);
    }
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->findAll($sql);
    }
}