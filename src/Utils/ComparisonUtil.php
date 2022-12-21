<?php

namespace ArrQ\Utils;

class ComparisonUtil
{
    /**
     * @param mixed $value1
     * @param mixed $value2
     * @param string $operator
     * @return bool
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public static function compareByOperator($value1, $value2, $operator)
    {
        $supportedOperators = ['=', '<', '<=', '>=', '>'];
        if(!in_array($operator, $supportedOperators))
            throw new \InvalidArgumentException("Could not find comparison operator with symbol '$operator'");

        switch ($operator) {
            case '=':
                return $value1 == $value2;
            case '<':
                return $value1 < $value2;
            case '<=':
                return $value1 <= $value2;
            case '>=':
                return $value1 >= $value2;
            case '>':
                return $value1 > $value2;
            default:
                throw new \RuntimeException("Comparison operator is registered on list, but functionallity is not defined.");
        }
    }
}