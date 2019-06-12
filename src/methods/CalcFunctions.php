<?php

namespace Calc\Methods;

use Calc\Exceptions\CalcException;
use Calc\Readers\Reader as reader;
use DivisionByZeroError;

trait CalcFunctions {

    /**
     * Returns one value if a logical expression is `TRUE` and another if it is `FALSE`.
     *
     * @param string $logicalExpression
     * @param string $valueIfTrue
     * @param string $valueIfFalse
     * @return mixed|null
     */
    public function cIf(string $logicalExpression, string $valueIfTrue, string $valueIfFalse = null){
        $result = null;
        try{
            if (reader::retrieveValidEvalExpresion($logicalExpression)){
                $result = reader::retrieveValidEvalExpresion($valueIfTrue);
            }else{
                $result = reader::retrieveValidEvalExpresion($valueIfFalse);
            }
            return $result;
        }catch (CalcException $exception){
            return $exception->getMessage();
        }catch (DivisionByZeroError $error){
            return $error->getMessage();
        }
    }

    /**
     * Rounds one number to the nearest integer multiple of another.
     *
     * @param string $value Round value
     * @param string $factor
     * @return mixed|string
     */
    public function cMRound(string $value, string $factor){
        try{
            $result = reader::retrieveValidEvalExpresion("round($value / $factor) * $factor");
            return $result;
        }catch (CalcException $exception){
            return $exception->getMessage();
        }
    }


    /**
     * Rounds a number up to the nearest integer multiple of specified significance.
     *
     * @param string $value
     * @param string $factor
     * @return mixed|string
     */
    public function cCeiling(string $value, string $factor = '1'){
        try {
            $result = reader::retrieveValidEvalExpresion("ceil($value / $factor) * $factor");
            return $result;
        } catch (CalcException $exception) {
            return $exception->getMessage();
        } catch (DivisionByZeroError $error){
            return $error->getMessage();
        }
    }

    /**
     * Rounds a number down to the nearest integer multiple of specified significance.
     *
     * @param string $value
     * @param string $factor
     * @return mixed|string
     */
    public function cFloor(string $value, string $factor = '1'){
        try {
            $result = reader::retrieveValidEvalExpresion("floor($value / $factor) * $factor");
            return $result;
        } catch (CalcException $exception) {
            return $exception->getMessage();
        } catch (DivisionByZeroError $error){
            return $error->getMessage();
        }
    }

    /**
     * Retrieve
     *
     * @param string $value
     * @return mixed|string
     */
    public function singleOperation(string $value){
        try{
            $result = reader::retrieveValidEvalExpresion($value);
            return $result;
        }catch (CalcException $exception){
            return $exception->getMessage();
        }catch (DivisionByZeroError $error){
            return $error->getMessage();
        }
    }

}
