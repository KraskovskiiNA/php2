<?php

namespace app\controllers;

use app\models\User;

class UserController extends Controller
{
    public function allAction()
    {
        $users = User::getAll();
        return $this->renderer->render('userAll', ['users' => $users]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $user = User::getOneGood($id);
        return $this->renderer->render('userOne', ['user' => $user, 'title' => $user->login]);
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->renderer->render('userAdd');
        }
        $user = new User;
        $user->password = $_POST['password'];
        $user->login = $_POST['login'];
        $user->name = $_POST['name'];
        $user->save();

        header('location: /');
        return '';
    }
}