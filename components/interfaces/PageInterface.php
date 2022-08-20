<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 7:08
 */

namespace components\interfaces;

interface PageInterface
{
    public function addBtn():string;
    public function getTitle():string;
    public function getView():string;
    public function setNotification():bool;
}