<?php

namespace PhpFp\Combinators\Test;

use PhpFp\Combinators;

class KTest extends \PHPUnit_Framework_TestCase
{
    public function testK()
    {
        $f = Combinators::K(3);

        $this->assertEquals(
            $f(2),
            3,
            'Creates a constant.'
        );
    }
}
