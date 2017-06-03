<?php
declare(strict_types=1);

namespace PhpFp;

// Create the _ placeholder constant to be used with bind
define(__NAMESPACE__ . '\\_', \bin2hex(\random_bytes(128)));

/**
 * bind :: (b -> c) -> a -> c
 */
function bind(callable $f, ...$x): callable
{
    return function (...$y) use ($f, $x) {
        // Replace all _ placeholders with passed parameters
        $z = array_map(function ($x) use (&$y) {
            return _ === $x ? array_shift($y) : $x;
        }, $x);
        // Execute $f with passed arguments
        return $f(...array_merge($z, $y));
    };
}
