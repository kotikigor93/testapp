<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 6:57
 */

namespace components\mappers;

use components\enums\PageTypeEnum;
use components\Mapper;

class PageTypeMapper extends Mapper
{
    protected $titleMap = [
        PageTypeEnum::PAGE_A => 'Страница А',
        PageTypeEnum::PAGE_B => 'Страница В',
    ];

    public function __construct()
    {
        parent::__construct($this->titleMap);
    }
}