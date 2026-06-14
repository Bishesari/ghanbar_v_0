<?php

function conv_j($gdate)
{
    $year = date('Y', strtotime($gdate));
    $month = date('m', strtotime($gdate));
    $day = date('d', strtotime($gdate));

    return gregorian_to_jalali($year, $month, $day, '/');
}


function j_date($gd)
{
    $ts = strtotime($gd);
    $df = jdate('Y/m/d l', $ts, '', '', 'en');

    return $df;
}

function currency($num)
{
    if (strlen($num) > 0) {
        return number_format($num, 0, '.', '/ ');
    } else {
        return $num;
    }
}
