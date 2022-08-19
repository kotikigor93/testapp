<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 22:41
 */

namespace components\mappers;

use components\enums\UserRolesTypeEnum;
use components\Mapper;

class UserRolesTypeMapper extends Mapper
{
    protected $titleMap = [
        UserRolesTypeEnum::ADMIN => 'Администратор',
        UserRolesTypeEnum::USER => 'Пользователь',
    ];

    public function __construct()
    {
        parent::__construct($this->titleMap);
    }
}