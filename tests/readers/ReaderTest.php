<?php


use Calc\Readers\Reader as reader;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{

    /**
     * ReaderTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function testReader(){
        $actualResult = reader::reader("IF(1>3;1;3)");
        $this->assertIsArray($actualResult);
        $this->assertArrayHasKey('methods', $actualResult);
        $actualResult = reader::reader("(51 - 12) * 2");
        $this->assertArrayNotHasKey('methods', $actualResult);
    }
}
