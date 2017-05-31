<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\compose;
use function PhpFp\curry;
use function PhpFp\flip;

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

    public function testFlipCompose()
    {
        $ucstrict = compose('ucfirst', 'strtolower');
        $lcstrict = flip(curry(compose))('ucfirst', 'strtolower');

        $this->assertSame('Abc', $ucstrict('ABC'));
        $this->assertSame('abc', $lcstrict('ABC'));
    }
}
