<?php
use app\services\RenderServices;

include dirname(__DIR__) . "/vendor/autoload.php";

$controllerName = 'user';
if (!empty(trim($_GET['c']))) {
    $controllerName = trim($_GET['c']);
}

$actionName = '';
if (!empty(trim($_GET['a']))) {
    $actionName = trim($_GET['a']);
}

$controllerClass = '\\app\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    /**
     * @var app\controllers\UserController $controller 
     */
    $renderer = new RenderServices();
    $controller = new $controllerClass($renderer);
    echo $controller->run($actionName);
} else {
    echo '404';
}


