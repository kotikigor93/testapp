<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 1:36
 */

namespace app\models;

use components\ExpandetModel;
use components\services\Notification;

class Statistic extends ExpandetModel
{
    protected $notification;

    public function __construct()
    {
        parent::__construct();
        $this->notification = new Notification();
    }

    /**
     * @param array $params
     * @return array
     */
    public function findListByFilterParams(array $params = []):array
    {
        return $this
            ->notification
            ->setLimit($this->limit)
            ->setOffset($this->offset)
            ->findTableRowByFilterParams($params);
    }
}