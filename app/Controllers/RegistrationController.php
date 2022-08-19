<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 16:22
 */

namespace app\Controllers;

use app\models\Registration;
use app\models\Users;
use components\Controller;
use components\enums\NotificationTypeEnum;
use components\services\NotificationService;
use components\SRC;

class RegistrationController extends Controller
{
    public function actionRegistration()
    {
        if($_SESSION['user_id']){
            SRC::redirect('index');
        }
        $data = [
            'view_title' => 'Регистрация',
        ];
        $this->viewLoad(
            'registration',
            $data
        );
    }

    public function actionRegistrationUser()
    {
        $result = [];
        if($_POST){
            $registration = new Registration();
            $notification = new NotificationService();
            if($result = $registration->registrationUser($_POST)){
                $notification->save(NotificationTypeEnum::REGISTRATION, $result['user_id'], CURRENT_DATETIME);
            }
            echo $this->ajax($result);
        }
    }

}