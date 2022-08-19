<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 0:29
 */

namespace components\services;

class NotificationService
{
    /**
     * @var Notification
     */
    private $notification;

    public function __construct()
    {
        $this->notification = new Notification();
    }

    /**
     * @param $type
     * @param $userId
     * @param $dateCreated
     * @return bool
     */
    public function save($type, $userId, $dateCreated)
    {
        return $this
            ->notification
            ->setType($type)
            ->setUserId($userId)
            ->setDateCreated($dateCreated)
            ->save();
    }

    public function findList()
    {
        return $this->notification->findList();
    }
}