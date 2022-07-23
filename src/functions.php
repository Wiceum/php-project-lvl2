<?php

use function Functional\zip;

function addSign($elems, $sign): array
{
    return array_map(function ($elem) use ($sign) {
        return [$elem, 'sign' => $sign];
    }, $elems);
}

function repack($arr): array
{
    $keys = array_keys($arr);
    $values = array_values($arr);
    return zip($keys, $values);
}

function replaceByLine($elem): string
{
    if ($elem === true) {
        return "true";
    } elseif ($elem === false) {
        return "false";
    } else {
        return $elem;
    }
}

function mapToStr($arr): array
{
    $smt = array_map(function ($elem) {
        return "  " . $elem['sign'] .
            " " . (replaceByLine($elem[0][0])) . ": " . (replaceByLine($elem[0][1])) .
            PHP_EOL;
    }, $arr);
    array_unshift($smt, "{" . PHP_EOL);
    $smt[] = "}" . PHP_EOL;
    return $smt;
}

function mySort(&$res)
{
    uasort($res, function ($a, $b) {
        $x = $a[0][0];
        $y = $b[0][0];
        if ($x === $y) {
            if ($a['sign'] === '-') {
                return -1;
            } else {
                return 1;
            }
        }
        return $x < $y ? -1 : 1;
    });
}

function stringify(array $arr)
{
    return array_reduce($arr, fn($acc, $elem) => $acc . $elem, '');
}
