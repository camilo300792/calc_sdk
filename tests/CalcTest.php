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

    public function testCalcIfWithParams(){
        $expectedResult = 0; //Value if true
        $actualResult = $this->calc->cIf('98 < 201', 0, '(98 * 0.18)');
        $this->assertEquals($expectedResult, $actualResult);
        $expectedResult = 17.64; //Value if true
        $actualResult = $this->calc->cIf('98 < 20', 0, '(98 * 0.18)');
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testCalcCeilingWithParams(){
        $expectedResult = 100000;
        $actualResult = $this->calc->cCeiling(98342, 10000);
        $this->assertEquals($expectedResult, $actualResult);
        $expectedResult = -90000;
        $actualResult = $this->calc->cCeiling(-98342, 10000);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testCalcIfWithFormula() {
        $expectedResult = 0;
        $actualResult = $this->calc->calc('=IF(40,5 + 15 < 201; 0; 40,5 + 15 * 4%)');
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testCalcCeilingWithFormula(){
        $expectedResult = 39900;
        $actualResult = $this->calc->calc('=CEILING(32 * 1000 - 240 / -45; 10000) - 100');
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testCalcNestedCeilingWithFormula(){
        $expectedResult = -90000;
        $actualResult = $this->calc->calc('=CEILING(CEILING(-98342;10000); 100)');
        $this->assertEquals($expectedResult, $actualResult);
    }
}

