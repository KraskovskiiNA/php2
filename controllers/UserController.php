<?php

namespace app\controllers;

use app\models\User;

class UserController 
{
    protected $defaultAction = 'all';

    public function run($action)
    {
        if (empty($action)) {
            $action = $this->defaultAction;
        }

        $action .= 'Action';

        if (!method_exists($this, $action)) {
            return '404';
        }
        return $this->$action();
    }

    public function allAction()
    {
        $users = User::getAll();
        return $this->render('userAll', ['users' => $users]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $user = User::getOneGood($id);
        return $this->render('userOne', ['user' => $user, 'title' => $user->login]);
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->render('userAdd');
        }
        $user = new User;
        $user->password = $_POST['password'];
        $user->login = $_POST['login'];
        $user->name = $_POST['name'];
        $user->save();

        header('location: /');
        return '';
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        $title = 'My shop';
        if (!empty($params['title'])) {
            $title = $params[$title];
        }
        return $this->renderTmpl('layouts/main', ['content' => $content, 'title' => $title]);
    }

    public function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }

    protected function getId()
    {
        if (empty($_GET['id'])) {
            return 0;
        }
        return (int)$_GET['id'];
    }
}