<?php

namespace app\services;
use app\traits\SingletonTrait;

class DB
{
    use SingletonTrait;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'gbphp',
        'charset' => 'UTF8',
        'login' => 'root',
        'passwd' => 'root'
    ];
    private $connection;

    private function getConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new \PDO($this->getSDN(),$this->config['login'],$this->config['passwd']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function getSDN()
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
                            $this->config['driver'],
                            $this->config['host'],
                            $this->config['dbname'],
                            $this->config['charset']);
    }

    private function qwery($sql, $params = [])
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function find($sql, $params = [])
    {
        return $this->qwery($sql, $params)->fetch();
    }

    public function findAll($sql, $params = [])
    {
        return $this->qwery($sql, $params)->fetchAll();
    }
    
    public function findObject($sql, $className, $params = [])
    {
        $PDOStatement = $this->qwery($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $PDOStatement->fetch();
    }

    public function findAllObject($sql, $className, $params = [])
    {
        $PDOStatement = $this->qwery($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $PDOStatement->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        $this->qwery($sql, $params);
    }

    public function getLastId()
    {
        return $this->getConnection()->lastInsertId();
    }
}
