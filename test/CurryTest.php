<?php

namespace PhpFp\Combinators\Test;

use PHPUnit\Framework\TestCase;

use function PhpFp\curry;
use function PhpFp\curry_exactly;

class CurryTest extends TestCase
{
    public function testCurry()
    {
        $sum = curry(static function ($a, $b, $c) {
            return $a + $b + $c;
        });

        $this->assertSame(6, $sum(1, 2, 3));
        $this->assertSame(6, $sum(1, 2)(3));
        $this->assertSame(6, $sum(1)(2, 3));
        $this->assertSame(6, $sum(1)(2)(3));

        $concat = curry(static function ($a, $b, $join = '') {
            return $a . $join . $b;
        }, 3);

        $this->assertSame(
            'a:b',
            $concat('a', 'b')(':'),
            'It curries exactly with optional arguments.'
        );

        $this->assertSame(
            [1, 2],
            curry('array_merge')([1], [2]),
            'It curries native functions.'
        );

        $this->assertSame(
            'Hello, world!',
            curry([$this, 'say'])('world'),
            'It curries object methods.'
        );

        $this->assertSame(
            'Goodbye, test!',
            curry(sprintf('%s::%s', self::class, 'bye'))('test'),
            'It curries static methods.'
        );
    }

    public function say($name)
    {
        return "Hello, $name!";
    }

    public static function bye($name)
    {
        return "Goodbye, $name!";
    }
}
