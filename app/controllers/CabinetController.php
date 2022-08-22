<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 18:23
 */

namespace app\Controllers;

use app\middleware\Middleware;
use app\models\Users;
use components\Controller;
use components\mappers\UserRolesTypeMapper;

class CabinetController extends Controller
{
    public function __construct()
    {
        Middleware::checkAuthorization();
    }

    public function actionIndex()
    {
        $user = new Users();
        $role = new UserRolesTypeMapper();
        $userData = [];
        if($_SESSION['user_id']){
            $user->setId($_SESSION['user_id']);
            $userData = $user->init()->getData();
        }
        $data = [
            'view_title' => 'Кабинет',
            'user' => $userData[0],
            'role_list' => $role->getTitleList()
        ];
        $this->viewLoad(
            'index',
            $data,
        );
    }

    public function actionError()
    {
        $data = [
            'view_title' => 'Error 404',
        ];
        $this->viewLoad(
            'error',
            $data
        );
    }
}