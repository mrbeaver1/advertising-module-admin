<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;

class InitialController extends Controller
{
    public function actionUser()
    {
        $username = $this->prompt('Username:', ['required' => true, 'default' => 'Test']);
        $password = $this->prompt('Password:', ['required' => true, 'default' => 'testtest']);
        $email = $this->prompt('Email:', ['required' => true, 'default' => 'test@gmail.com']);

        User::makeInitial($username, $password, $email);

        $this->stdout("Username: $username\nPassword: $password\nEmail: $email\n");
    }
}