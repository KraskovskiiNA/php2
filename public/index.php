<?php
namespace app;
require __DIR__ . "/vendor/autoload.php";
// include dirname(__DIR__) . "/services/autoLoad.php";
// spl_autoload_register([(new autoLoad()), 'load']);

$bd = new DB();
$good = new Good($bd);
echo $good->getOneGood(12);
echo '<hr>';
echo $good->getAll();
