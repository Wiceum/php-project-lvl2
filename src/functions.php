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

function stringify($arr): array
{
    return array_map(function ($elem) {
        return "  " . $elem['sign'] .
            " " . (replaceByLine($elem[0][0])) . ": " . (replaceByLine($elem[0][1])) .
            PHP_EOL;
    }, $arr);
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
    });/*dump($res);*/
}

function myPrint($str)
{
    echo "{" . PHP_EOL;
    foreach ($str as $smt) {
        echo $smt;
    }
    echo "}" . PHP_EOL;
}
