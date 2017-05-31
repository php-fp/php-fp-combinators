<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\if_else;
use function PhpFp\k;

class IfElseTest extends \PHPUnit_Framework_TestCase
{
    public function testIfElse()
    {
        $isOdd = function ($x) { return $x % 2 === 1; };
        $odd = function ($x) { return $x * 3 + 1; };
        $even = function ($x) { return $x / 2; };

        $collatz = if_else($isOdd, $odd, $even);

        $this->assertSame(10, $collatz(3));
        $this->assertSame(1, $collatz(2));

        $f = if_else(
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
