<?php
declare(strict_types=1);

namespace PhpFp\Combinators;

use ReflectionFunction;
use ReflectionMethod;
use Reflector;

final class Curry
{
    /**
     * @var callable
     */
    private $fn;

    /**
     * @var int
     */
    private $arity;

    /**
     * @var array
     */
    private $args;

    /**
     * Wrap a callable in a curry.
     */
    public function __construct(callable $fn, $arity = null)
    {
        $this->fn = $fn;
        $this->arity = $arity ?? $this->numberOfParameters($fn);
        $this->args = [];
    }

    /**
     * Apply the curry with some parameters.
     */
    public function __invoke(...$args)
    {
        $args = array_merge($this->args, $args);

        if (count($args) >= $this->arity) {
            // All parameters have been defined, execute the function
            return call_user_func_array($this->fn, $args);
        }

        // Additional parameters are needed, return another curry
        $copy = clone $this;
        $copy->args = $args;

        return $copy;
    }

    private function reflect(callable $fn): Reflector
    {
        if (is_array($fn)) {
            return new ReflectionMethod($fn[0], $fn[1]);
        }

        if (is_string($fn) && strpos($fn, '::')) {
            return new ReflectionMethod($fn);
        }

        if (is_object($fn)) {
            return new ReflectionMethod($fn, '__invoke');
        }

        return new ReflectionFunction($fn);
    }

    private function numberOfParameters(callable $fn): int
    {
        return $this->reflect($fn)->getNumberOfRequiredParameters();
    }
}
