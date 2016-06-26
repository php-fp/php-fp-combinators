<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\Combinators\Combinators\compose2;

class Compose2Test extends \PHPUnit_Framework_TestCase
{
    public function testCompose2()
    {
        $add = function ($x, $y)
        {
            return $x + $y;
        };

        $halve = function ($x)
        {
            return $x / 2;
        };

        $f = compose2($halve, $add);

        $this->assertEquals(
            $f(3, 5),
            4,
            'Composes correctly.'
        );

        $this->assertEquals(
            $f(2, 3),
            2.5,
            'Types correctly handled.'
        );
    }
}
