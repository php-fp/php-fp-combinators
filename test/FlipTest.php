<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\Combinators\Combinators\flip;

class FlipTest extends \PHPUnit_Framework_TestCase
{
    public function testFlip()
    {
        $subtract = function ($x, $y)
        {
            return $x - $y;
        };

        $subtractFrom = flip($subtract);

        $this->assertEquals(
            $subtractFrom(2, 9),
            7,
            'Flips.'
        );
    }
}
