<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use function Differ\gendiff;

class DifferTest extends TestCase
{
    //getFixtureFullPath

    private $strToTest = '';

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->strToTest = file_get_contents('tests/fixtures/1_string.txt');
    }

    public function testFlattenJsonsDiffering()
    {
        $this->assertEquals($this->strToTest, gendiff('tests/fixtures/file1.json', 'tests/fixtures/file2.json'));
    }
}
