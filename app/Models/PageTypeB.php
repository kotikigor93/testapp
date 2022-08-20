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

class PageTypeB extends ExpandetModel implements PageInterface
{
    protected $title = 'Страница B';

    protected $view = 'page';

    public function addBtn(): string
    {
        return '<a href="/storage/putty.exe" class="btn btn-success" id="click_btn" data-type="'.NotificationTypeEnum::BTN_CLICK_B.'">Скачать файл</a>';
    }

    /**
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @return bool
     */
    public function setNotification():bool
    {
        $notification = new NotificationService();
        return $notification->save(NotificationTypeEnum::VIEW_PAGE_B, $_SESSION['user_id'], CURRENT_DATETIME);
    }
}