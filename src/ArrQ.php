<?php
namespace ArrQ;

use ArrQ\Utils\ComparisonUtil;
use ArrQ\Utils\SortingUtil;

class ArrQ
{
    private array $queryArray;
    private bool $containsObjects;

    /**
     * ArrQ constructor.
     * @param $queryObject
     */
    public function __construct($queryObject)
    {
        if(!is_array($queryObject))
            throw new \InvalidArgumentException("Query object must be an array.");
        if(isset($queryObject[0]) && is_object($queryObject[0]))
            $this->setContainsObjects(true);

        $this->setQueryArray($queryObject);
    }

    /**
     * @return array
     */
    public function getQueryArray(): array
    {
        return $this->queryArray;
    }

    /**
     * @param array $queryArray
     */
    private function setQueryArray(array $queryArray): void
    {
        $this->queryArray = $queryArray;
    }

    /**
     * @return bool
     */
    private function containsObjects(): bool
    {
        return $this->containsObjects;
    }

    /**
     * @param bool $containsObjects
     */
    private function setContainsObjects(bool $containsObjects): void
    {
        $this->containsObjects = $containsObjects;
    }

    public function sortByKey($key,$order='ASC')
    {
        $sortedArray = $this->getQueryArray();
        if(empty($sortedArray))
            return;

        if($this->containsObjects())
        {
            if($sortedArray[0]->$key ?? false)
                throw new \InvalidArgumentException("Given key was not found as object property.");
            $sortedArray = SortingUtil::sortArrayOfObjects($sortedArray,$key,$order);
        }
        else
        {
            if(!isset($sortedArray[0][$key]))
                throw new \InvalidArgumentException("Given key was not found as array key.");
            $sortedArray = SortingUtil::sortArrayOfItems($sortedArray,$key,$order);
        }

        $this->setQueryArray($sortedArray);
    }

    public function where($key,$value,$operator='=')
    {
        $queryArray = $this->getQueryArray();
        $resultArray = [];
        if($this->containsObjects())
        {
            foreach ($queryArray as $item)
            {
                if(ComparisonUtil::compareByOperator($item->$key,$value,$operator))
                {
                    $resultArray[] = $item;
                }
            }
        }
        else
        {
            foreach ($queryArray as $item)
            {
                if(ComparisonUtil::compareByOperator($item[$key],$value,$operator))
                {
                    $resultArray[] = $item;
                }
            }
        }

        return new ArrQ($resultArray);
    }

    public function distinct()
    {
        $queryArray = $this->getQueryArray();
        $duplicatedIndexes = [];
        if($this->containsObjects())
        {
            for($i=0;$i<sizeof($queryArray);$i++)
            {
                for($j=$i+1;$j<sizeof($queryArray);$j++)
                {
                    if($queryArray[$i] == $queryArray[$j])
                        $duplicatedIndexes = $j;
                }
            }
        }

        foreach ($duplicatedIndexes as $duplicatedIndex)
        {
            unset($queryArray[$duplicatedIndex]);
        }

        //Re-Index array
        return array_values($queryArray);
    }
}