<?php


namespace Calc;
use Calc\Readers\Reader as reader;
use Calc\Methods\CalcFunctions;

class Calc
{
    private $formula;
    use CalcFunctions;

    public function calc($formula)
    {
        $this->formula = $formula;
        if(isset(reader::reader($this->formula)['methods'])){
            return round($this->replaceFormulaWithCalcFunction(reader::reader($this->formula)['methods']), 2);
        }else{
            return round($this->singleOperation($this->formula), 2);
        }
    }

    private function replaceFormulaWithCalcFunction(array $foundMethods)
    {
        $result = null;
        $methods = sizeof($foundMethods) - 1;
        # Nested: first method found, first method resolved
        for ($i = $methods; $i >= 0; $i--) {
            $method = $foundMethods[$i][0];
            $sections = reader::divideFormulaSections();
            switch ($method){
                case 'IF':
                    $logicalExpression = $sections[0];
                    $valueIfTrue = $sections[1];
                    $valueIfFalse = $sections[2] ?? null;
                    $formula = reader::retrievePlainFormula($method, $this->cIf($logicalExpression, $valueIfTrue, $valueIfFalse));
                    if (!reader::containMethod()) {
                        $result = $this->singleOperation($formula);
                    }
                    break;
                case $method == 'CEILING' || $method == 'FLOOR': #Factor isn't mandatory
                    $value = $sections[0];
                    $factor = $sections[1] ?? 1;
                    $partialResult = ($method == 'CEILING') ? $this->cCeiling($value, $factor):$this->cFloor($value, $factor);
                    $formula = reader::retrievePlainFormula($method, $partialResult);
                    if (!reader::containMethod()) {
                        $result = $this->singleOperation($formula);
                    }
                    break;
                case 'MROUND': #Factor is $mandatory
                    $value = $sections[0];
                    $factor = $sections[1];
                    $formula = reader::retrievePlainFormula($method, $this->cMRound($value, $factor));
                    if (!reader::containMethod()) {
                        $result = $this->singleOperation($formula);
                    }
                    break;
            }
        }
        return $result;
    }

}
