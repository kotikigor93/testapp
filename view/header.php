<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 19:50
 */
use components\enums\UserRolesTypeEnum;
use components\SRC;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/css/custom.css">
    <script src="/lib/js/jquery-3.5.1.min.js"></script>
    <script src="/lib/js/sweetalert_old.all.min.js"></script>
    <script type="text/javascript" src="/lib/js/bootstrap.min.js"></script>
    <title><?= $data['view_title'] ?></title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="main_body col-6">
            <h2>MY <span class="title_color">TEST APP</span></h2>
        </div>
    </div>
</div>
<? if($_SESSION['user_id']) { ?>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/index">Профиль</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/page/1">Страница А</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/page/2">Страница В</a>
                </li>
                <? if(SRC::isAdmin($_SESSION['user_id'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="/statistics/1">Статистика</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/reports">Отчет</a>
                </li>
                <? } ?>
            </ul>
        </div>
        <div class="logout btn btn-danger m-2" data-id="<?= $data['user']['id'] ?>">
            Выйти
        </div>
    </nav>
</div>
<? } ?>