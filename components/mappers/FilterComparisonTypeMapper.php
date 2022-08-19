<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 4:46
 */

namespace components\mappers;

use components\enums\FilterComparisonTypeEnum;
use components\Mapper;

class FilterComparisonTypeMapper extends Mapper
{
    protected $titleMap = [
        FilterComparisonTypeEnum::EQUAL => '=',
        FilterComparisonTypeEnum::LESS => '<',
        FilterComparisonTypeEnum::MORE => '>',
        FilterComparisonTypeEnum::LESS_EQUAL => '<=',
        FilterComparisonTypeEnum::MORE_EQUAL => '>=',
        FilterComparisonTypeEnum::LIKE => 'LIKE',
        FilterComparisonTypeEnum::IN => 'IN',
        FilterComparisonTypeEnum::NOT_IN => 'NOT IN',
        FilterComparisonTypeEnum::NOT_EQUAL => '<>',
        FilterComparisonTypeEnum::IS => 'IS',
        FilterComparisonTypeEnum::IS_NOT => 'IS NOT',
        FilterComparisonTypeEnum::BETWEEN => 'BETWEEN',
    ];

    public function __construct()
    {
        parent::__construct($this->titleMap);
    }
}