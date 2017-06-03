<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\k;

class KTest extends \PHPUnit_Framework_TestCase
{
    public function testK()
    {
        $f = k(3);

        $this->assertEquals(
            $f(2),
            3,
            'Creates a constant.'
        );
    }
}
