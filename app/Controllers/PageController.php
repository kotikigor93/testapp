<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 6:42
 */

namespace app\Controllers;

use components\Controller;
use components\enums\NotificationTypeEnum;
use components\factory\PageFactory;
use components\services\NotificationService;

class PageController extends Controller
{
    public function actionPage(int $pageType = 0){
        $pageFactory = new PageFactory();
        $page = $pageFactory->create($pageType);
        $page->setNotification();
        $data = [
            'view_title' => $page->getTitle(),
            'btn' => $page->addBtn(),
        ];
        $this->viewLoad(
            $page->getView(),
            $data,
        );
    }

    public function actionClickButton()
    {
        $notification = new NotificationService();
        $btnType = $_POST['type'] == NotificationTypeEnum::BTN_CLICK_B ? NotificationTypeEnum::BTN_CLICK_B : NotificationTypeEnum::BTN_CLICK_A;
        $notification->save($btnType , $_SESSION['user_id'], CURRENT_DATETIME);
        echo $this->ajax([
            'result' => true
        ]);
    }
}