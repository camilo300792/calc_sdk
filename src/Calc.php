<?php


namespace Calc;
use Calc\Readers\Reader as reader;
use Calc\Methods\CalcFunctions;

class Calc
{
    private $formula;
    use CalcFunctions;

    public function calc($formula) {
        $this->formula = $formula;
        if(isset(reader::reader($this->formula)['methods'])){
            return round($this->replaceFormulaWithCalcFunction(reader::reader($this->formula)['methods']), 2);
        }else{
            return round($this->singleOperation($this->formula), 2);
        }
    }

    public function replaceFormulaWithCalcFunction(array $foundMethods) {
        $result = null;
        foreach ($foundMethods as $method){
            switch ($method[0]){
                case 'IF':
                    preg_match_all('/\([^()]*\)/', $this->formula, $matches);
                    $formula = explode(';', preg_replace(['/[()]/', '/%/'], ['', '/100'], implode('', $matches[0])));
                    $result = $this->cIf($formula[0], $formula[1], $formula[2]);
                    break;
                case 'CEILING':
                    preg_match_all('/\([^()]*\)/', $this->formula, $matches);
                    $formula = explode(';', preg_replace(['/[()]/', '/%/'], ['', '/100'], implode('', $matches[0])));
                    //Cambiar $factor por opcional
                    $value = preg_replace('/^=?'.$method[0].'\([^()]*\)/', $this->cCeiling($formula[0], isset($formula[1]) ? $formula[1]:1), $this->formula);
                    $result = $this->singleOperation($value);
                    break;
                case 'MROUND':
                    preg_match_all('/\([^()]*\)/', $this->formula, $matches);
                    $formula = explode(';', preg_replace(['/[()]/', '/%/'], ['', '/100'], implode('', $matches[0])));
                    $value = preg_replace('/^=?'.$method[0].'\([^()]*\)/', $this->cMRound($formula[0], $formula[1]), $this->formula);
                    $result = $this->singleOperation($value);
                    break;
            }
        }
        return $result;
    }
}
