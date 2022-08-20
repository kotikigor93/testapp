<?php
/**
 * Created by Kotyk Ihor
 * Date : 20.07.2022
 * Time : 15:57
 */

namespace components;

use components\factory\FilterFactory;
use components\mappers\FilterComparisonTypeMapper;
use PDO;

abstract class ExpandetModel
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $mainTable = 'tree';

    /**
     * @var string
     */
    protected $orderBy = 'id';

    /**
     * @var string
     */
    protected $sort = 'DESC';

    /**
     * @var string
     */
    protected $params = '';

    /**
     * @var string
     */
    protected $value = '';

    /**
     * @var array
     */
    protected $insertData = [];

    /**
     * @var string
     */
    protected $where = '';

    /**
     * @var int
     */
    protected $limit = 0;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @var string
     */
    protected $union = '';

    /**
     * @var DB
     */
    protected $dbConect;

    public function __construct()
    {
        $this->dbConect = new DB();
    }

    /**
     * @return $this
     */
    public function init():self
    {
        $this->data = $this->getCurrentTableRow();
        return $this;
    }

    /**
     * @param string $mainTable
     * @return $this
     */
    public function setMainTable(string $mainTable):ExpandetModel
    {
        $this->mainTable = $mainTable;
        return $this;
    }

    /**
     * @param string $orderBy
     * @return $this
     */
    public function setOrderBy(string $orderBy):ExpandetModel
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param string $sort
     * @return $this
     */
    public function setSort(string $sort):ExpandetModel
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param array $insertData
     * @return $this
     */
    public function setInsertData(array $insertData): ExpandetModel
    {
        $this->insertData = $insertData;
        return $this;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): ExpandetModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit):ExpandetModel
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset(int $offset):ExpandetModel
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return array
     */
    public function getData():array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    protected function getCurrentTableRow(): array
    {
        $result = $this->dbConect->query('SELECT * FROM '.$this->mainTable.' WHERE id = '.$this->id);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * @return array
     */
    protected function getTableRows(): array
    {
        $limit = $this->limit ? ' LIMIT '. $this->limit : '';
        $offset = $this->offset ? ' OFFSET '. $this->offset : '';
        $result = $this->dbConect->query('SELECT * FROM '.$this->mainTable.' ORDER BY '.$this->orderBy .' '.$this->sort.$limit.$offset);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * @return int
     */
    protected function insertTableRow():int
    {
        foreach ($this->insertData as $key => $val){
            $this->params .= $key.',';
            $this->value .= "'".$val."',";
        }
        $this->params = substr($this->params, 0, -1);
        $this->value = substr($this->value, 0, -1);
        $this->dbConect->query('INSERT INTO '.$this->mainTable.' ('.$this->params.') VALUES ('.$this->value.')');
        return $this->dbConect->lastInsertId();
    }

    /**
     * @return bool
     */
    protected function delTableRowById():bool
    {
        return (bool)$this->dbConect->query('DELETE FROM ' . $this->mainTable . ' WHERE id =' . $this->id . ' OR parent =' . $this->id);
    }

    /**
     * @param array $params
     * @return array
     */
    protected function findTableRowByParams(array $params = []):array
    {
        $limit = $this->limit ? ' LIMIT '. $this->limit : '';
        $offset = $this->offset ? ' OFFSET '. $this->offset : '';
        foreach ($params as $key => $val) {
            $this->where .= $this->where ? ' AND ' : ' ';
            SRC::isNumeric($val) ? $this->where .= $key .' = '. $val : $this->where .= $key .' = "'. $val .'"';
        }
        $where = $this->where ? ' WHERE '. $this->where : '';
        $result = $this->dbConect->query('SELECT * FROM '. $this->mainTable.$where .' ORDER BY '. $this->orderBy .' '. $this->sort. $limit . $offset);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * @param array $params
     * @return array
     */
    protected function findTableRowByFilterParams(array $params = []):array
    {
        $filterFactory = new FilterFactory();
        $filterList = ($filterFactory->create($params['filter_name']))->getFilterList();

        $comparisonMapper = new FilterComparisonTypeMapper();
        $comparisonList = $comparisonMapper->getTitleList();

        foreach ($params['filter_value'] as $key => $value){
            if(array_key_exists($key, $filterList)){
                if(!empty($value)){
                    $this->where .= $this->where ? ' AND ' : ' ';
                    SRC::isNumeric($value)
                        ? $this->where .= $key . $comparisonList[$filterList[$key]['comparison']]. $value
                        : $this->where .= $key .  $comparisonList[$filterList[$key]['comparison']]. '"'. $value .'"';
                }
            }
        }

        $limit = $this->limit ? ' LIMIT '. $this->limit : '';
        $offset = $this->offset ? ' OFFSET '. $this->offset : '';
        $where = $this->where ? ' WHERE '. $this->where : '';
        $result = $this->dbConect->query('SELECT * FROM '. $this->mainTable.$where .' ORDER BY '. $this->orderBy .' '. $this->sort. $limit . $offset);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * @return array
     */
    protected function findTableRowsByUnion():array
    {
        $result = $this->dbConect->query($this->union.' ORDER BY '. $this->orderBy .' '. $this->sort. $limit . $offset);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * @param string $selectList
     * @param array $whereList
     * @param string $groupByList
     * @return $this
     */
    public function addUnionRow(string $selectList = '', array $whereList = [], string $groupByList = ''):ExpandetModel
    {
        $this->union .=
            $this->union
                ? ' UNION SELECT '.$selectList
                : 'SELECT '.$selectList;
        $this->union .= ' FROM '.$this->mainTable;

        $comparisonMapper = new FilterComparisonTypeMapper();
        $comparisonList = $comparisonMapper->getTitleList();
        $this->where = '';

        foreach ($whereList as $item){
            $this->where .= $this->where ? ' AND ' : ' ';
            SRC::isNumeric($item['value'])
                ? $this->where .= $item['name'] . $comparisonList[$item['comparison']]. $item['value']
                : $this->where .= $item['name'] . $comparisonList[$item['comparison']]. '"'. $item['value'] .'"';
        }
        $where = $this->where ? ' WHERE '. $this->where : '';

        $this->union .= $where;
        $this->union .= ' GROUP BY '.$groupByList;

        return $this;
    }
}