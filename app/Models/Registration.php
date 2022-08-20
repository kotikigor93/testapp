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
    /**
     * @param $params
     * @return array
     */
    public function registrationUser($params):array
    {
        $user = new Users();
        $user
            ->setUsername($params['username'])
            ->setPassword($params['password'])
            ->setEmail($params['email'])
            ->setFirstname($params['firstname'])
            ->setLastname($params['lastname']);
        return $user->save();
    }
}