<?php
declare(strict_types=1);

namespace PhpFp;

use PhpFp\Combinators\Curry;

/**
 * curry :: a -> b -> c
 */
function curry(callable $fn, int $arity = null): callable
{
    return new Curry($fn, $arity);
}

/**
 * compose :: (b -> c), (a -> b) -> a -> c
 */
function compose(...$args)
{
    return curry('\PhpFp\Combinators\compose')(...$args);
}

/**
 * flip :: (a, b -> c) -> (b, a) -> c
 */
function flip(...$args)
{
    return curry('\PhpFp\Combinators\flip')(...$args);
}

/**
 * id :: a -> a
 */
function id(...$args)
{
    return curry('\PhpFp\Combinators\id')(...$args);
}

/**
 * if_else :: (a -> Bool), (a -> b), (a -> b) -> a -> b
 */
function if_else(...$args)
{
    return curry('\PhpFp\Combinators\if_else')(...$args);
}

/**
 * k :: a -> b ->  a
 */
function k(...$args)
{
    return curry('\PhpFp\Combinators\k')(...$args);
}

/**
 * on :: (b, b -> c), (a -> b) -> a, a -> c
 */
function on(...$args)
{
    return curry('\PhpFp\Combinators\on')(...$args);
}
