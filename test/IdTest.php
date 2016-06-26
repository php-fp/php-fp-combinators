<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\Combinators\Combinators\id;

class IdTest extends \PHPUnit_Framework_TestCase
{
    public function testId()
    {
        $this->assertEquals(2, id(2), 'Identity.');
    }
}
