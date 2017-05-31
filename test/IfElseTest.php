<?php

namespace PhpFp\Combinators\Test;

use PhpFp\Combinators;

use function PhpFp\k;

class IfElseTest extends \PHPUnit_Framework_TestCase
{
    public function testIfElse()
    {
        $isOdd = function ($x) { return $x % 2 === 1; };

        $f = Combinators::ifElse(
            $isOdd,
            k('Oops!'),
            function ($x) {
                return "$x is even!";
            }
        );

        $this->assertEquals($f(1), 'Oops!', 'Success');
        $this->assertEquals($f(2), '2 is even!', 'Failure');
    }
}
