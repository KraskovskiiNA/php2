<?php
use app\services\AutoLoad;
use app\models\Good;
include dirname(__DIR__) . "/services/autoLoad.php";
spl_autoload_register([(new autoLoad()), 'load']);

$bd = new \app\services\DB();
$good = new Good($bd);
echo $good->getOneGood(12);
echo '<hr>';
echo $good->getAll();
