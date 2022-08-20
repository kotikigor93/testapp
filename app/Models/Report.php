<?php
/**
 * Created by Kotyk Ihor
 * Date : 20.08.2022
 * Time : 0:53
 */

namespace app\models;

use components\enums\FilterComparisonTypeEnum;
use components\ExpandetModel;
use components\services\Notification;

class Report extends ExpandetModel
{
    protected $notification;

    public function __construct()
    {
        parent::__construct();
        $this->notification = new Notification();
    }

    /**
     * @param array $listType
     * @return array
     */
    public function findReportsFullList(array $listType = []):array
    {
        foreach($listType as $type){
            $this->notification
                ->addUnionRow(
                    'type , date_created, COUNT(*) as count',
                    [
                        [
                            'name' => 'type',
                            'value' => $type,
                            'comparison' => FilterComparisonTypeEnum::EQUAL
                        ]
                    ],
                    'date_created'
                );
        }
        return $this->notification
            ->setOrderBy('date_created')
            ->setSort('DESC')
            ->findTableRowsByUnion();
    }
}