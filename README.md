# Functional combinators for PHP. [![Build Status](https://travis-ci.org/php-fp/php-fp-combinators.svg?branch=master)](https://travis-ci.org/php-fp/php-fp-combinators)

## Intro

Combinators are simple functions that allow you to modify the behaviour of values and functions after they have been created. These allow greater reuse of functions and reduction of boilerplate.

## API

These combinators aren't fully curried by default - mainly for optimisation reasons - but are designed so that most common use cases can be satisfied as is. Consequently, the type signatures use the comma (`,`) to represent multiple arguments.

### `curry :: a -> b -> c`

Transform a callable that takes multiple parameters into a callable that takes one parameter and returns another function any more parameters are needed.

```php
use function PhpFp\curry;

$sum = curry(function ($a, $b, $c) {
    return $a + $b + c;
});

// The following statements are all equivalent:
assert(6 === $add(1, 2, 3));
assert(6 === $add(1)(2)(3));
assert(6 === $add(1, 2)(3));
assert(6 === $add(1)(2, 3));
```

Note that currying ignores optional parameters. To curry optional parameters, set the arity:

```php
use function PhpFp\curry;

$concat = function ($a, $b, $join = '') {
    return $a . $join . $b;
};
$concat = curry($concat, 3);

assert('a:b' === $concat('a', 'b', ':'));
```


### `compose :: (b -> c), (a -> b) -> a -> c`

Instead of writing `function ($x) { return f(g(x)); }`, `compose` allows us to express this as `compose('f', 'g')` (where the parameters could be closures, invokables, or anything that can be used as a "function"). Given two functions, `f` and `g`, a function will be returned that takes a value, `x`, and returns `f(g(x))`. This operation is _associative_, so `compose` calls can nest to create longer chains of functions. A simple, two-function example is shown here:

```php
<?php

use PhpFp\Combinators as F;

$strictUcFirst = F::compose('ucfirst', 'strtolower');
$strictUcFirst('HELLO, WORLD'); // Hello, world
```

Note that the functions are called **from left to right**. If the opposite is desired, this can be achieved easily:

```php
<?php

use PhpFp\Combinators as F;

// The `flip` function is discussed later in this document.
$pipe = flip(F::compose());
$pipe($f, $g)($x) === $g($f($x));
```

### `flip :: (a, b -> c) -> (b, a) -> c`

This function takes a two-argument function, and returns the same function with the arguments swapped round:

```php
<?php

use PhpFp\Combinators as F;

$divide = function ($x, $y) { return $x / $y; };
$divideBy = F::flip($divide);

$divideBy(2, 10); // 5
```

This function becomes much more useful for functions that are curried. It can be useful in composition chains and point-free expressions.

### `id :: a -> a`

Returns whatever it was given! Again, this is useful in composition chains for the times when you don't want to do anything to the value (see `converge`):

```php
<?php

use PhpFp\Combinators as F;

F::id(2); // 2
F::id('hello'); // hello
```

### `ifElse :: (a -> Bool), (a -> b), (a -> b) -> a -> b`

This function allows for conditionals in composition chains. Unlike `converge`, which branches and merges, `ifElse` chooses which function to run based on the predicate, and the other function is ignored:

```php
<?php

use PhpFp\Combinators as F;

$isOdd = function ($x) { return $x % 2 === 1; };
$odd = function ($x) { return $x * 3 + 1; };
$even = function ($x) { return $x / 2; };

$collatz = F::ifElse($isOdd, $odd, $even);
$collatz(3); // 10
$collatz(10); // 5
```

### `k :: a -> b -> a`

This function takes a value, and then returns a function that always returns that value, regardless of what it receives. This creates a "constant" function to wrap a value in places where invocation is expected:

```php
use PhpFp\Combinators as F;

use function PhpFp\k;

$isOdd = function ($x) { return $x % 2 === 1; };

$f = F::ifElse($isOdd, k('Oops!'), function ($x) { return "$x is even!"; });
$f(1); // 'Oops!'
$f(2); // '2 is even!'
```

### `on :: (b, b -> c), (a -> b) -> a, a -> c`

This function, also called the `Psi` combinator, allows you to call a function on transformations of values. This is really useful for things like sorting on particular properties of objects: we can call a compare function on two objects given a transformation. It's probably best illustrated with an example:

```php
<?php

// Get an array value.
$prop = function ($k)
{
    return function ($xs) use ($k)
    {
        return $xs[$k];
    };
};

// Sort arrays by their 'test' key.
$sort = function ($xs, $f) use ($prop)
{
    $ys = array_slice($xs, 0);
    usort($ys, on($f, $prop('test')));

    return $ys;
};

// Standard comparison function.
$f = function ($a, $b) { return $a <=> $b; };

$test = [
    ['title' => 'hello',     'test' => 3],
    ['title' => 'goodbye',   'test' => 2],
    ['title' => 'something', 'test' => 4]
];

array_column($sort($test, $f), 'title'); // ['goodbye', 'hello', 'something']
```

## Contributing

If I've missed any of your favourite combinators, feel free to submit a PR. If you have a good idea about how to make any of this README clearer, that would be so great: while these combinators are not new to functional programmers, they _are_ complex and need to be explained well. All help is appreciated :)
