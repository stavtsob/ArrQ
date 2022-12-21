<?php

namespace ArrQ\Utils;

class SortingUtil
{
    /**
     * @param array<int, object> $array
     * @param string|int $key
     * @param string $order
     * @return array<int, object>
     */
    public static function sortArrayOfObjects($array, $key, $order = 'ASC')
    {
        if($order == 'ASC')
        {
            for ($i = 0; $i < sizeof($array); $i++)
            {
                $minIdx = $i;
                $minVal = $array[$i]->$key;
                for ($j = $i + 1; $j < sizeof($array); $j++)
                {
                    if ($minVal > $array[$j]->$key)
                    {
                        $minVal = $array[$j]->$key;
                        $minIdx = $j;
                    }
                }

                $tmpVal = $array[$i];
                $array[$i] = $array[$minIdx];
                $array[$minIdx] = $tmpVal;
            }
        }
        elseif ($order == 'DESC')
        {
            for ($i = 0; $i < sizeof($array); $i++)
            {
                $maxIdx = $i;
                $maxVal = $array[$i]->$key;
                for ($j = $i + 1; $j < sizeof($array); $j++)
                {
                    if ($maxVal < $array[$j]->$key)
                    {
                        $maxVal = $array[$j]->$key;
                        $maxIdx = $j;
                    }
                }

                $tmpVal = $array[$i];
                $array[$i] = $array[$maxIdx];
                $array[$maxIdx] = $tmpVal;
            }
        }
        return $array;
    }
    
    /**
     * @param array<int, array<int|string, mixed>> $array
     * @param string|int $key
     * @param string $order
     * @return array<int, array<int|string, mixed>>
     */
    public static function sortArrayOfItems($array, $key, $order = 'ASC')
    {
        if($order == 'ASC')
        {
            for ($i = 0; $i < sizeof($array); $i++)
            {
                $minIdx = $i;
                $minVal = $array[$i][$key];
                for ($j = $i + 1; $j < sizeof($array); $j++)
                {
                    if ($minVal > $array[$j][$key])
                    {
                        $minVal = $array[$j][$key];
                        $minIdx = $j;
                    }
                }

                $tmpVal = $array[$i];
                $array[$i] = $array[$minIdx];
                $array[$minIdx] = $tmpVal;
            }
        }
        elseif ($order == 'DESC')
        {
            for ($i = 0; $i < sizeof($array); $i++)
            {
                $maxIdx = $i;
                $maxVal = $array[$i][$key];
                for ($j = $i + 1; $j < sizeof($array); $j++)
                {
                    if ($maxVal < $array[$j][$key])
                    {
                        $maxVal = $array[$j][$key];
                        $maxIdx = $j;
                    }
                }

                $tmpVal = $array[$i];
                $array[$i] = $array[$maxIdx];
                $array[$maxIdx] = $tmpVal;
            }
        }

        return $array;
    }
}