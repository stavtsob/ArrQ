<?php

namespace ArrQ;

use ArrQ\Utils\ComparisonUtil;
use ArrQ\Utils\SortingUtil;

class ArrQ
{
    /**
     * @var array<int, array<int|string, mixed>>|array<int, object> $queryArray
     */
    private array $queryArray;

    /**
     * @var bool $containsObjects
     */
    private bool $containsObjects;

    /**
     * ArrQ constructor.
     * @param array<int, array<int|string, mixed>>|array<int, object> $queryObject
     * @throws \InvalidArgumentException
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
     * @return array<int, array<int|string, mixed>>|array<int, object>
     */
    public function getQueryArray(): array
    {
        return $this->queryArray;
    }

    /**
     * @param array<int, array<int|string, mixed>>|array<int, object> $queryArray
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

    /**
     * @param string $key
     * @param string $order
     * @return void
     * @throws \InvalidArgumentException
     */
    public function sortByKey($key, $order = 'ASC'): void
    {
        $sortedArray = $this->getQueryArray();
        if(empty($sortedArray))
            return;

        if($this->containsObjects())
        {
            /**
             * @var array<int, object> $sortedArray
             */
            if($sortedArray[0]->$key ?? false)
                throw new \InvalidArgumentException("Given key was not found as object property.");
            $sortedArray = SortingUtil::sortArrayOfObjects($sortedArray, $key, $order);
        }
        else
        {
            /**
             * @var array<int, array<int|string, mixed>> $sortedArray
             */
            if(!isset($sortedArray[0][$key]))
                throw new \InvalidArgumentException("Given key was not found as array key.");
            $sortedArray = SortingUtil::sortArrayOfItems($sortedArray, $key, $order);
        }

        $this->setQueryArray($sortedArray);
    }

    /**
     * @param string|int $key
     * @param string|int $value
     * @param string $operator
     * @return ArrQ
     */
    public function where($key, $value, $operator = '=')
    {
        $queryArray = $this->getQueryArray();
        $resultArray = [];
        if($this->containsObjects())
        {
            /**
             * @var array<int, object> $queryArray
             */
            foreach ($queryArray as $item)
            {
                if(ComparisonUtil::compareByOperator($item->$key, $value, $operator))
                {
                    $resultArray[] = $item;
                }
            }
        }
        else
        {
            /**
             * @var array<int, array<int|string, mixed>> $queryArray
             */
            foreach ($queryArray as $item)
            {
                if(ComparisonUtil::compareByOperator($item[$key], $value, $operator))
                {
                    $resultArray[] = $item;
                }
            }
        }

        return new ArrQ($resultArray);
    }

    /**
     * @return array<int, array<int|string, mixed>>|array<int, object>
     */
    public function distinct()
    {
        $queryArray = $this->getQueryArray();

        /**
         * @var array<int, int>|array<int, string>
         */
        $duplicatedIndexes = [];

        if($this->containsObjects())
        {
            for($i = 0; $i < sizeof($queryArray); $i++)
            {
                for($j = $i + 1; $j < sizeof($queryArray); $j++)
                {
                    if($queryArray[$i] == $queryArray[$j])
                        $duplicatedIndexes[] = $j;
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