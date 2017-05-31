<?php
declare(strict_types=1);

namespace PhpFp;

use PhpFp\Combinators\Curry;

/**
 * compose :: (b -> c), (a -> b) -> a -> c
 */
function compose(callable $f, callable $g): callable
{
    return static function ($x) use ($f, $g) {
        return $f($g($x));
    };
}
define('compose', '\PhpFp\compose');

/**
 * curry :: a -> b -> c
 */
function curry(callable $fn, int $arity = null): callable
{
    return new Curry($fn, $arity);
}
define('curry', '\PhpFp\curry');

/**
 * k :: a -> b ->  a
 */
function k($x): callable
{
    return static function () use ($x) {
        return $x;
    };
}
define('k', '\PhpFp\k');
