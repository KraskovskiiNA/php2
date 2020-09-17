<?php
use app\services\AutoLoad;
use app\models\Good;
use app\models\User;
include dirname(__DIR__) . "/services/autoLoad.php";
spl_autoload_register([(new AutoLoad()), 'load']);


$good = new User();
$goodModel = $good->insert(1,2,3);
var_dump($goodModel);
echo '<hr>';
var_dump($good->getAll());