<?php


namespace ArrQ\Utils;


class ComparisonUtil
{
    public static function compareByOperator($value1,$value2,$operator)
    {
        $supportedOperators = ['=','<','<=','>=','>'];
        if(!in_array($operator,$supportedOperators))
            throw new \InvalidArgumentException("Could not found comparison operator with symbol '$operator'");

        if($operator == '=')
        {
            return $value1 == $value2;
        }
        elseif ($operator == '<')
        {
            return $value1 < $value2;
        }
        elseif ($operator == '<=')
        {
            return $value1 <= $value2;
        }
        elseif ($operator == '>=')
        {
            return $value1 >= $value2;
        }
        elseif ($operator == '>')
        {
            return $value1 > $value2;
        }
        else
        {
            throw new \RuntimeException("Comparison operator is registered on list, but functionallity is not defined.");
        }
    }
}