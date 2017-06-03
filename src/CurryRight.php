<?php
declare(strict_types=1);

namespace PhpFp\Combinators;

class CurryRight extends Curry
{
    protected static function apply(callable $fn, array $args)
    {
        return parent::apply($fn, array_reverse($args));
    }
}
