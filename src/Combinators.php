<?php

namespace PhpFp;

use Cypress\Curry as C;

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
        $f = C\curry([self::class, "{$name}_"]);
        return count($args) ? $f(... $args) : $f;
    }

    /**
     * Unary function composition.
     * @param callable $f Outer function.
     * @param callable $g Inner function.
     * @return callable A composed unary function.
     */
    public static function compose_(callable $f, callable $g, $value)
    {
        return $f($g($value));
    }

    /**
     * Flip the arguments of a binary function.
     * @param callable $f The function to flip.
     * @return callable The flipped function.
     */
    public static function flip_(callable $f, $y, $x)
    {
        return $f($x, $y);
    }

    /**
     * Identity combinator. Return the parameter.
     * @param mixed $x Anything in the world.
     * @return mixed Exactly what $x was.
     */
    public static function id_($x)
    {
        return $x;
    }

    /**
     * Conditional branching.
     * @param callable $p A boolean predicate.
     * @param callable $f The "true" function.
     * @param callable $g The "false" function.
     * @return mixed The result of the chosen function.
     */
    public static function ifElse_($p, $f, $g, $x)
    {
        return $p($x) ? $f($x) : $g($x);
    }

    /**
     * Constant function.
     * @param mixed $x The constant value.
     * @return callable A unary function that returns $x.
     */
    public static function K_($x, $_)
    {
        return $x;
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
