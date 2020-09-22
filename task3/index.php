<?php

var_dump(sortArr());

function sortArr()
{
    $args = $_SERVER['argv'];
    $array = (array_slice($args, 1));
    $array = array_unique($array);
    $array = array_filter($array, function ($value) {
        return (preg_match('#^(-)*[0-9]+$#', $value) && $value !== '-0');

    });
    sort($array);
    return $array;
}