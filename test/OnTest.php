<?php

namespace PhpFp\Combinators\Test;

use function PhpFp\on;

class OnTest extends \PHPUnit_Framework_TestCase
{
    public function testOn()
    {
        $prop = function ($k)
        {
            return function ($xs) use ($k)
            {
                return $xs[$k];
            };
        };

        $sort = function ($xs, $f) use ($prop)
        {
            $ys = array_slice($xs, 0);
            usort($ys, on($f, $prop('test')));

            return $ys;
        };

        $f = function ($a, $b)
        {
            return $a <=> $b;
        };

        $test = [
            [
                'title' => 'hello',
                'test' => 3
            ],

            [
                'title' => 'goodbye',
                'test' => 2
            ],

            [
                'title' => 'something',
                'test' => 4
            ]
        ];

        $this->assertEquals(
            array_column($sort($test, $f), 'title'),
            ['goodbye', 'hello', 'something'],
            'Transforms parameters.'
        );
    }
}
