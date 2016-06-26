<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\Combinators\Combinators\K;

class KTest extends \PHPUnit_Framework_TestCase
{
    public function testK()
    {
        $f = K(3);

        $this->assertEquals(
            $f(2),
            3,
            'Creates a constant.'
        );
    }
}
