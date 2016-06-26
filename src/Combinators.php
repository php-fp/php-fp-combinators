<?php

namespace PhpFp\Combinators\Combinators;

/**
 * Unary function composition.
 * compose(f, g) === x => f (g (x))
 * @param callable $f Outer function.
 * @param callable $g Inner function.
 * @return callable A composed unary function.
 */
function compose(callable $f, callable $g) : callable
{
    return function ($x) use ($f, $g)
    {
        return $f($g($x));
    };
}

/**
 * Binary function composition. We could go on,
 * but I've personally never found much use for
 * any composition beyond binary. You get the pattern.
 * compose2(f, g) === (x, y) => f (g (x, y))
 * @param callable $f Outer function.
 * @param callable $g Inner function.
 * @return callable A composed binary function.
 */
function compose2(callable $f, callable $g) : callable
{
    return function ($x, $y) use ($f, $g)
    {
        return $f($g($x, $y));
    };
}

/**
 * (Big) Phi combinator.
 * @param callable $h Final function.
 * @param callable $f First parameter transformer.
 * @param callable $g Second parameter transformer.
 * @return callable A unary function.
 */
function converge(callable $h, callable $f, callable $g) : callable
{
    return function ($x) use ($h, $f, $g)
    {
        return $h($f($x), $g($x));
    };
}

/**
 * Flip the arguments of a binary function.
 * @param callable $f The function to flip.
 * @return callable The flipped function.
 */
function flip(callable $f) : callable
{
    return function ($y, $x) use ($f)
    {
        return $f($x, $y);
    };
}

/**
 * Identity combinator. Return the parameter.
 * @param mixed $x Anything in the world.
 * @return mixed Exactly what $x was.
 */
function id($x)
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
function ifElse($p, $f, $g) : callable
{
    return function ($x) use ($p, $f, $g)
    {
        return $p($x) ? $f($x) : $g($x);
    };
}

/**
 * Constant function.
 * @param mixed $x The constant value.
 * @return callable A unary function that returns $x.
 */
function K($x) : callable
{
    return function ($_) use ($x)
    {
        return $x;
    };
}

/**
 * Psi combinator.
 * @param callable $f The outer function.
 * @param callable $nt The parameter transformer.
 * @return callable The transformed function.
 */
function on(callable $f, callable $nt) : callable
{
    return function ($x, $y) use ($f, $nt)
    {
        return $f($nt($x), $nt($y));
    };
}
