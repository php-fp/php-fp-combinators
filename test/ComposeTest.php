<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\compose;

class ComposeTest extends \PHPUnit_Framework_TestCase
{
    public function testCompose()
    {
        $inc = function ($x)
        {
            return $x + 1;
        };

        $halve = function ($x)
        {
            return $x / 2;
        };

        $f = compose($halve, $inc);

        $this->assertEquals(
            $f(3),
            2,
            'Composes correctly.'
        );

        $this->assertEquals(
            $f(2),
            1.5,
            'Types correctly handled.'
        );
    }
}
