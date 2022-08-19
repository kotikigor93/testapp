<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 0:31
 */

namespace components\services;

use components\ExpandetModel;

class Notification extends ExpandetModel
{
    protected $mainTable = 'notification';

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $dateCreated;

    public function __construct()
    {
        parent::__construct();
        $this->setMainTable($this->mainTable);
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type):Notification
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param $userId
     * @return $this
     */
    public function setUserId($userId):Notification
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param $dateCreated
     * @return $this
     */
    public function setDateCreated($dateCreated):Notification
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return array
     */
    public function findList():array
    {
        return $this
            ->setOrderBy('id')
            ->setSort('DESC')
            ->setLimit($this->limit)
            ->setOffset($this->offset)
            ->getTableRows();
    }

    public function save()
    {
        $this->setInsertData([
            'type' => $this->type,
            'user_id' => $this->userId,
            'date_created' => $this->dateCreated,
        ]);
        $this->insertTableRow();
        return true;
    }
}