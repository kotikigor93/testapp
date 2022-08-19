<?php
/**
 * Created by Kotyk Ihor
 * Date : 18.08.2022
 * Time : 22:37
 */

namespace components;


abstract class Mapper
{
    protected $titleMap = [];

    /**
     * Mapper constructor.
     * @param array $titleMap
     */
    public function __construct(array $titleMap = [])
    {
        $this->titleMap = $titleMap;
    }

    /**
     * @return array $titleMap
     */
    public function getTitleList():array
    {
        return $this->titleMap;
    }

    /**
     * @param $type
     * @return string
     */
    public function getTitleByType($type):string
    {
        return $this->titleMap[$type];
    }

}