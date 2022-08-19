<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 20:27
 */

namespace app\models;

use components\enums\NotificationTypeEnum;
use components\ExpandetModel;
use components\services\Notification;
use components\services\NotificationService;

class Login extends ExpandetModel
{
    /**
     * @param array $params
     * @return bool
     */
    public function singIn($params = []):bool
    {
        $user = new Users();
        $notification = new NotificationService();
        $params = [
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
        ];
        if($userData = $user->findUserByParams($params)){
            $_SESSION['user_id'] = $userData[0]['id'];
            $notification->save(NotificationTypeEnum::SING_IN,  (int)$userData[0]['id'], CURRENT_DATETIME);
            return true;
        }
        return false;
    }

    /**
     * @param $id
     */
    public function logout($id)
    {
        $notification = new NotificationService();
        $notification->save(NotificationTypeEnum::LOGOUT, $_SESSION['user_id'], CURRENT_DATETIME);
        unset($_SESSION['user_id']);
    }
}