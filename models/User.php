<?php

namespace app\models;

class User()
{
    public $id;
    public $name;
    public $login;
    public $password;


    protected function getTableName():string
    {
        return 'users';
    }
}