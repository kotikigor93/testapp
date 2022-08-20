<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 18:45
 */

//all routes
$routes = [
    '' => 'cabinet/index',
    'index' => 'cabinet/index',
    'registration' => 'registration/registration',
    'registrationuser' => 'registration/registrationuser',
    'login' => 'login/login',
    'singin' => 'login/singin',
    'logout' => 'login/logout',
    'statistics/([0-9]+)' => 'statistic/statistic/$1',
    'page/([0-9]+)' => 'page/page/$1',
    'click_btn' => 'page/clickbutton',
    'reports' => 'report/report',
];