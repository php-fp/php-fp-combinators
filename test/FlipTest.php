<?php

namespace PhpFp\Combinators\Test;

use PhpFp\Combinators;

class FlipTest extends \PHPUnit_Framework_TestCase
{
    public function testFlip()
    {
        $subtract = function ($x, $y)
        {
            return $x - $y;
        };

        $subtractFrom = Combinators::flip($subtract);

        $this->assertEquals(
            $subtractFrom(2, 9),
            7,
            'Flips.'
        );
    }
}
