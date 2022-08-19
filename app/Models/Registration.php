<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 16:34
 */

namespace app\models;

use components\ExpandetModel;

class Registration extends ExpandetModel
{
    public function registrationUser($params):array
    {
        $user = new Users();
        $user
            ->setUsername($_POST['username'])
            ->setPassword(md5($_POST['password']))
            ->setEmail($_POST['email'])
            ->setFirstname($_POST['firstname'])
            ->setLastname($_POST['lastname']);
        return $user->save();
    }
}