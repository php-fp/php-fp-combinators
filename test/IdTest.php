<?php

namespace PhpFp\Combinators\Test;

use PhpFp\Combinators;

class IdTest extends \PHPUnit_Framework_TestCase
{
    public function testId()
    {
        $this->assertEquals(
            2,
            Combinators::id(2),
            'Identity.'
        );
    }
}
