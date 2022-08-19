<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 4:41
 */

namespace components\enums;


class FilterComparisonTypeEnum
{
    const EQUAL = 1;
    const LESS = 2;
    const MORE = 3;
    const LESS_EQUAL = 4;
    const MORE_EQUAL = 5;
    const LIKE = 6;
    const IN = 7;
    const NOT_IN = 8;
    const NOT_EQUAL = 9;
    const IS = 10;
    const IS_NOT = 11;
    const BETWEEN = 12;
}