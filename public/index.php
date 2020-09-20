<?php
use app\services\AutoLoad;
use app\models\Good;
use app\models\User;
include dirname(__DIR__) . "/services/autoLoad.php";
spl_autoload_register([(new AutoLoad()), 'load']);



// $goodModel = User::getOneGood('2');
// var_dump($goodModel);
// echo '<hr>';
// var_dump(User::getAll());


