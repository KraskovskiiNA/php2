<?php

use app\services\Request;
use app\services\TwigRenderServices;

include dirname(__DIR__) . "/vendor/autoload.php";
$request = new Request();

$controllerName = 'user';
if (!empty($request->getActionName())) {
    $controllerName = $request->getControllerName();
}

$controllerClass = '\\app\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    /**
     * @var app\controllers\UserController $controller 
     */
    $renderer = new TwigRenderServices();
    $controller = new $controllerClass($renderer, $request);
    echo $controller->run($request->getActionName());
} else {
    echo '404';
}


