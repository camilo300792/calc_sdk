<?php

namespace Calc\Readers;

use Calc\Exceptions\CalcException;

abstract class Reader
{
    /**
     *
     * Formula to read
     * @var
     */
    public static $formula;

    /**
     * Available sheets methods
     */
    const METHODS = 'IF|CEILING|MROUND|FLOOR';

    /**
     * Read sheets formula and returns its info
     *
     * @param $formula
     * @return array
     */
    public static function reader(string $formula): array {
        self::$formula = $formula;
        $formulaInfo = [];
        if (self::containMethod()){
            $formulaInfo['methods'] = self::whatMethods();
        }
        return $formulaInfo;
    }

    /**
     * Divide formula in sheets sections
     *
     * @return array
     */
    public static function divideFormulaSections() {
        $pattern = '/\([^()]*\)/';
        preg_match_all($pattern, self::$formula, $matches);
        $sections = explode(';', preg_replace('/[()]/', '', implode('', $matches[0])));
        return $sections;
    }

    /**
     * Return plain formula
     *
     * @param $method
     * @param $result
     * @return string|string[]|null
     */
    public static function retrievePlainFormula($method, $result) {
        $pattern = '/=?' . $method . '\([^()]*\)/';
        self::$formula = preg_replace($pattern, $result, self::$formula);
        return self::$formula;
    }

    /**
     * Determine if the formula contains valid methods
     *
     * @return bool
     */
    public static function containMethod(){
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