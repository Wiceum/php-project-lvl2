<?php

namespace Differ;

function gendiff($filepath1, $filepath2): string
{
    $str1 = file_get_contents($filepath1);
    $arr1 = json_decode($str1, true);

    $str2 = file_get_contents($filepath2);
    $arr2 = json_decode($str2, true);

    $same = array_intersect_assoc($arr1, $arr2);
    $diff1 = array_diff_assoc($arr1, $arr2); // add +
    $diff2 = array_diff_assoc($arr2, $arr1); // add -

    $diff1 = addSign(repack($diff1), '-');
    $diff2 = addSign(repack($diff2), '+');
    $same = addSign(repack($same), ' ');

    $res = array_merge($diff1, $diff2, $same);
    mySort($res);

    return  stringify(mapToStr($res));
}