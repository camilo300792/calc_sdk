<?php


use Calc\Calc;
use PHPUnit\Framework\TestCase;

class CalcTest extends TestCase
{
    private $calc;

    /**
     * CalcTest constructor.
     * @param $calc
     */
    public function __construct()
    {
        parent::__construct();
        $this->calc = new Calc();
    }

    public function testCalcIfValue(){
        $expectedResult = 0; //Value if true
        $actualResult = $this->calc->cIf('98 < 201', 0, '(98 * 0.18)');
        $this->assertEquals($expectedResult, $actualResult);
        $expectedResult = 17.64; //Value if true
        $actualResult = $this->calc->cIf('98 < 20', 0, '(98 * 0.18)');
        $this->assertEquals($expectedResult, $actualResult);
    }
}

