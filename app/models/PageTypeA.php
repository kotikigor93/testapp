<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 7:03
 */

namespace app\models;

use components\enums\NotificationTypeEnum;
use components\ExpandetModel;
use components\interfaces\PageInterface;
use components\services\NotificationService;

class PageTypeA extends ExpandetModel implements PageInterface
{
    /**
     * @var string
     */
    protected $title = 'Страница А';

    /**
     * @var string
     */
    protected $view = 'page';

    public function addBtn(): string
    {
        return '<button class="btn btn-success" id="click_btn" data-type="'.NotificationTypeEnum::BTN_CLICK_A.'">Купить Корову</button>';
    }

    /**
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getView():string
    {
        return $this->view;
    }

    /**
     * @return bool
     */
    public function setNotification():bool
    {
        $notification = new NotificationService();
        return $notification->save(NotificationTypeEnum::VIEW_PAGE_A, $_SESSION['user_id'], CURRENT_DATETIME);
    }
}