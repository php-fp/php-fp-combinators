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
 * flip :: (a, b -> c) -> (b, a) -> c
 */
function flip(callable $f): callable
{
    return static function ($x, $y) use ($f) {
        return $f($y, $x);
    };
}
define('flip', '\PhpFp\flip');

/**
 * id :: a -> a
 */
function id($x)
{
    return $x;
}
define('id', '\PhpFp\id');

/**
 * if_else :: (a -> Bool), (a -> b), (a -> b) -> a -> b
 */
function if_else(callable $p, callable $f, callable $g): callable
{
    return function ($x) use ($p, $f, $g) {
        return $p($x) ? $f($x) : $g($x);
    };
}
define('if_else', '\PhpFp\if_else');

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
