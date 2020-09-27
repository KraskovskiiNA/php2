<?php
namespace app\controllers;

use app\models\Good;

class GoodController extends controller
{
    public function allAction()
    {
        $goods = Good::getAll();
        return 'Товары';
    }
}