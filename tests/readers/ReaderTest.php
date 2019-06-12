<?php


use Calc\Readers\Reader as reader;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{
    const FORMULA = 'IF(10 > 5); 0; 10 - 5';

    /**
     * ReaderTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        reader::$formula = self::FORMULA;
    }


}
