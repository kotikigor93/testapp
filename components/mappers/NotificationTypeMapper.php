<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 0:23
 */

namespace components\mappers;

use components\enums\NotificationTypeEnum;
use components\Mapper;

class NotificationTypeMapper extends Mapper
{
    protected $titleMap = [
        NotificationTypeEnum::SING_IN => 'Вход',
        NotificationTypeEnum::LOGOUT => 'Выход',
        NotificationTypeEnum::REGISTRATION => 'Регистрация',
        NotificationTypeEnum::VIEW_PAGE_A => 'Просмотр страницы А',
        NotificationTypeEnum::VIEW_PAGE_B => 'Просмотр страницы В',
        NotificationTypeEnum::BTN_CLICK_A => 'Купить корову',
        NotificationTypeEnum::BTN_CLICK_B => 'Скачать файл',
    ];

    public function __construct()
    {
        parent::__construct($this->titleMap);
    }
}