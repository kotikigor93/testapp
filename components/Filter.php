<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 4:54
 */

namespace components;

abstract class Filter
{
    /**
     * @var array|mixed
     */
    protected $filterList = [];

    public function __construct($filterList = [])
    {
        return $this->filterList = $filterList;
    }

    /**
     * @return array
     */
    public function getFilterList():array
    {
        return $this->filterList;
    }
}