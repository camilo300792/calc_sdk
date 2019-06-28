<?php

namespace Calc\Readers;

use Calc\Exceptions\CalcException;

abstract class Reader
{
    public static $formula;

    const METHODS = 'IF|CEILING|MROUND|FLOOR';

    const MATH_OPERATORS = '[+\/*\^%-]';

    public static function reader($formula){
        self::$formula = $formula;
        $formulaInfo = [];
        if (self::containMethod()){
            $formulaInfo['methods'] = self::whatMethods();
        }
        return $formulaInfo;
    }

    protected static function divideSingleFormula(){

    }

    /**
     * Determine
     *
     * @return bool
     */
    protected static function containMethod(){
        if (preg_match('/' . self::METHODS . '/i', self::$formula) === 1){
            return true;
        }
        return false;
    }

    /**
     * @return mixed|null
     */
    protected static function whatMethods(){
        preg_match_all('/' . self::METHODS . '/i', self::$formula, $matches, PREG_OFFSET_CAPTURE);
        return $matches[0];
    }

    /**
     * Test expression and return a valid value
     *
     * @param $expression
     * @return mixed
     * @throws CalcException
     */
    public static function retrieveValidEvalExpresion($expression){
        if(!preg_match_all('/(\d+([.]\d+)?|pi|π)/', $expression)){
            throw new CalcException("Formula should be contain valid values");
        }
        $validExpression = preg_replace(['/[\s\=]+/', '/\,+/', '/%/'], ['', '.', '/100'], $expression);

        return eval("return $validExpression ;");
    }

}