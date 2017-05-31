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

    /**
     * Psi combinator.
     * @param callable $f The outer function.
     * @param callable $nt The parameter transformer.
     * @return callable The transformed function.
     */
    public static function on_(callable $f, callable $nt, $x, $y)
    {
        return $f($nt($x), $nt($y));
    }
}
