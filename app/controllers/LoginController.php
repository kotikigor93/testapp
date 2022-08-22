<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 16:20
 */

namespace app\Controllers;

use app\models\Login;
use components\Controller;
use components\SRC;

class LoginController extends Controller
{
    public function actionLogin()
    {
        if($_SESSION['user_id']){
            SRC::redirect('index');
        }
        $data = [
            'view_title' => 'Авторизация',
        ];
        $this->viewLoad(
            'login',
            $data
        );
    }

    public function actionSingIn(){
        $login = new Login();
        echo $this->ajax([
            'result' => $login->singIn($_POST)
        ]);
    }

    public function actionLogout()
    {
        $login = new Login();
        $login->logout($_POST['id']);
        echo $this->ajax([
            'result' => true
        ]);
    }
}