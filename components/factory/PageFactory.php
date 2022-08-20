<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 6:59
 */

namespace components\factory;

use app\models\PageTypeA;
use app\models\PageTypeB;
use components\enums\PageTypeEnum;
use components\interfaces\PageInterface;

class PageFactory
{

    /**
     * @param int $pageType
     * @return PageInterface
     */
    public function create(int $pageType):PageInterface
    {
        switch ($pageType) {
            case PageTypeEnum::PAGE_A:
                $page = new PageTypeA();
                break;
            case PageTypeEnum::PAGE_B:
                $page = new PageTypeB();
                break;
        }
        return $page;
    }
}