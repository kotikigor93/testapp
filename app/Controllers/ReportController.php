<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 23:00
 */

namespace app\Controllers;

use app\models\Report;
use components\Controller;
use components\enums\NotificationTypeEnum;
use components\mappers\NotificationTypeMapper;
use components\SRC;

class ReportController extends Controller
{
    public function actionReport()
    {
        $report = new Report();
        $notificationMapper = new NotificationTypeMapper();
        $reportList = SRC::groupArrayByColumnKeepSorting(
            $report->findReportsFullList(
                [
                    NotificationTypeEnum::VIEW_PAGE_A,
                    NotificationTypeEnum::VIEW_PAGE_B,
                    NotificationTypeEnum::BTN_CLICK_A,
                    NotificationTypeEnum::BTN_CLICK_B
                ]
            ),
            'date_created');

        $data = [
            'view_title' => 'Отчеты',
            'report_list' => $reportList,
            'notification_list' => $notificationMapper->getTitleList(),
        ];
        $this->viewLoad(
            'reports',
            $data,
        );
    }
}