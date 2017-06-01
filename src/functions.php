<?php
declare(strict_types=1);

namespace PhpFp\Combinators;

/**
 * compose :: (b -> c), (a -> b) -> a -> c
 */
function compose(callable $f, callable $g): callable
{
    return static function ($x) use ($f, $g) {
        return $f($g($x));
    };
}

/**
 * flip :: (a, b -> c) -> (b, a) -> c
 */
function flip(callable $f): callable
{
    return static function ($x, $y) use ($f) {
        return $f($y, $x);
    };
}

/**
 * id :: a -> a
 */
function id($x)
{
    return $x;
}

/**
 * if_else :: (a -> Bool), (a -> b), (a -> b) -> a -> b
 */
function if_else(callable $p, callable $f, callable $g): callable
{
    return function ($x) use ($p, $f, $g) {
        return $p($x) ? $f($x) : $g($x);
    };
}

/**
 * k :: a -> b ->  a
 */
function k($x): callable
{
    return static function () use ($x) {
        return $x;
    };
}

/**
 * on :: (b, b -> c), (a -> b) -> a, a -> c
 */
function on(callable $f, callable $nt): callable
{
    return static function ($x, $y) use ($f, $nt) {
        return $f($nt($x), $nt($y));
    };
}
