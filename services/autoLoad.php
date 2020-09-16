<?php
namespace app\services;
class AutoLoad
{
    public function load($className)
    {
        $file = str_replace(['app\\', '\\'], [dirname(__DIR__) . '/', '/'], $className) . '.php';
        if (file_exists($file)){
            include $file;
        }
    }
}   