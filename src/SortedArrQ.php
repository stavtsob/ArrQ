<?php

namespace ArrQ;

class SortedArrQ extends ArrQ
{
    /**
     * @var string|int
     */
    private $sortingKey;

    /**
     * @param array<int, array<int|string, mixed>>|array<int, object> $queryObject
     * @param string $sortingKey
     */
    public function __construct($queryObject, $sortingKey)
    {
        parent::__construct($queryObject);

        $this->setSortingKey($sortingKey);
        $this->sortByKey($sortingKey);
    }

    /**
     * @return string|int
     */
    public function getSortingKey()
    {
        return $this->sortingKey;
    }

    /**
     * @param string|int $sortingKey
     */
    public function setSortingKey($sortingKey): void
    {
        $this->sortingKey = $sortingKey;
    }
}