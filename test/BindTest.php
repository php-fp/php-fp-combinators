<?php

namespace PhpFp\Combinators\Test;

use const PhpFp\_;
use function PhpFp\bind;

class BindTest extends \PHPUnit_Framework_TestCase
{
    public function testBind()
    {
        $dash = bind('implode', '-');

        $this->assertSame(
            '1-2-3',
            $dash([1, 2, 3]),
            'bind() creates partial functions.'
        );

        $cube = bind('pow', _, 3);

        $this->assertSame(
            8,
            $cube(2),
            'bind() accepts placeholders.'
        );
    }
}
