<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.08.2022
 * Time : 1:57
 */

namespace components;


final class Pagnation
{
    protected $amountItemsInPage = 20;

    protected $pageNumber = 1;

    public function __construct(int $pageNumber)
    {
        $this->pageNumber = $pageNumber;
    }

    /**
     * @return int
     */
    public function getAmountItemsInPage(): int
    {
        return $this->amountItemsInPage;
    }

    /**
     * @param int $amountItemInPage
     */
    public function setAmountItemsInPage(int $amountItemInPage)
    {
        $this->amountItemsInPage = $amountItemInPage;
    }

    /**
     * @return int
     */
    public function getPageStartValue(): int
    {
        return $this->amountItemsInPage * $this->pageNumber - $this->amountItemsInPage;
    }
}
