<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 5:02
 */

namespace components\filtered;

use components\enums\FilterComparisonTypeEnum;
use components\Filter;

class StatisticFilter extends Filter
{
    protected $filterList = [
        'type' => [
            'comparison' => FilterComparisonTypeEnum::EQUAL
        ],
        'user_id' => [
            'comparison' => FilterComparisonTypeEnum::EQUAL
        ],
        'date_created' => [
            'comparison' => FilterComparisonTypeEnum::MORE_EQUAL,
        ],
    ];

    public function __construct()
    {
        parent::__construct($this->filterList);
    }
}