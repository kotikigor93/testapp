<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 18:57
 */

namespace app\middleware;

use components\SRC;

class Middleware
{
    public static function checkAuthorization()
    {
        if(!$_SESSION['user_id']){
            unset($_SESSION['id_user']);
            SRC::redirect('/login');
        }
    }
}
