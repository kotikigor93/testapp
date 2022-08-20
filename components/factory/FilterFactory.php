<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 5:12
 */

namespace components\factory;

use components\Filter;

class FilterFactory
{
    /**
     * @param string $filterName
     * @return Filter
     */
    public function create(string $filterName = ''):Filter
    {
        $filter = '\components\filtered\\'.$filterName.'Filter';
        return new $filter();
    }

}