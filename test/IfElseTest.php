<?php

namespace PhpFp\Combinators\Test;

use PhpFp\Combinators;

class IfElseTest extends \PHPUnit_Framework_TestCase
{
    public function testIfElse()
    {
        $isOdd = function ($x) { return $x % 2 === 1; };

        $f = Combinators::ifElse(
            $isOdd,
            Combinators::K('Oops!'),
            function ($x) {
                return "$x is even!";
            }
        );

        $this->assertEquals($f(1), 'Oops!', 'Success');
        $this->assertEquals($f(2), '2 is even!', 'Failure');
    }
}
