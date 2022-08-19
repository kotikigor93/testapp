<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 1:36
 */

namespace app\Controllers;

use app\middleware\Middleware;
use app\models\Statistic;
use app\models\Users;
use components\Controller;
use components\enums\FilterComparisonTypeEnum;
use components\mappers\NotificationTypeMapper;
use components\Pagnation;
use components\SRC;

class StatisticController extends Controller
{
    public function __construct()
    {
        Middleware::checkAuthorization();
    }

    public function actionStatistic(int $page = 1)
    {
        $statistic = new Statistic();
        $pagination = new Pagnation($page);
        $usersList = new Users();
        $filterParams = [
            'filter_name' => 'Statistic',
            'filter_value' => [
                'type' => $_GET['filter_type'] ?? '',
                'user_id' => $_GET['filter_user'] ?? '',
                'date_created' => $_GET['filter_date'] ?? '',
            ],
        ];
        $statisticsList = $statistic
            ->setLimit($pagination->getAmountItemsInPage())
            ->setOffset($pagination->getPageStartValue())
            ->findListByFilterParams($filterParams);
        $notificationTypeList = new NotificationTypeMapper();
        $data = [
            'view_title' => 'Статистика',
            'statistic_list' => $statisticsList,
            'notification_type_list' => $notificationTypeList->getTitleList(),
            'current_page' => $page,
            'link' => '/statistics',
            'users_list' => SRC::groupArrayByColumn($usersList->findList(), 'id')
        ];
        $this->viewLoad(
            'statistic',
            $data
        );
    }
}