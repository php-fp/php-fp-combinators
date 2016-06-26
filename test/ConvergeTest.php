<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\Combinators\Combinators\converge;

class ConvergeTest extends \PHPUnit_Framework_TestCase
{
    public function testConverge()
    {
        $add = function ($x, $y)
        {
            return $x + $y;
        };

        $prop = function ($k)
        {
            return function ($xs) use ($k)
            {
                return $xs[$k];
            };
        };

        $f = converge($add, $prop('x'), $prop('y'));

        $this->assertEquals(
            $f(['x' => 2, 'y' => 3]),
            5,
            'Converges.'
        );
    }
}
