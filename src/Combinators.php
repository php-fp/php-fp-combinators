<?php

namespace PhpFp;

use function PhpFp\curry;

class Combinators
{
    /**
     * Return a curried version of a combinator.
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic($name, array $args)
    {
        $f = curry([self::class, "{$name}_"]);
        return count($args) ? $f(...$args) : $f;
    }
}
