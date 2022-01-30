<?php
namespace ArrQ;

class SortedArrQ extends ArrQ
{
    private $sortingKey;

    public function __construct($queryObject, $sortingKey)
    {
        parent::__construct($queryObject);

        $this->setSortingKey($sortingKey);
        $this->sortByKey($sortingKey);
    }

    /**
     * @return mixed
     */
    public function getSortingKey()
    {
        return $this->sortingKey;
    }

    /**
     * @param mixed $sortingKey
     */
    public function setSortingKey($sortingKey): void
    {
        $this->sortingKey = $sortingKey;
    }
}