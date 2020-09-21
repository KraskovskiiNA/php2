<?php
use app\services\AutoLoad;
use app\models\Good;
use app\models\User;
include dirname(__DIR__) . "/services/autoLoad.php";
spl_autoload_register([(new AutoLoad()), 'load']);


$user = User::getOneGood(3);
$user->name = 'newName';
$user->password = 101010;
$user->save();
