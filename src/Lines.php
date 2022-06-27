<?php

namespace Laracasts\Transcriptions;

use Countable;
use ArrayAccess;
use phpDocumentor\Reflection\Types\Boolean;

class Lines implements Countable, ArrayAccess
{

    public function __construct(protected array $lines)
    {
    }


    public function count(): int
    {
        return count([1, 2, 3]);
    }

    public function offsetExists($offset): bool
    {
        return false;
    }
    public function offsetGet($offset): mixed
    {
        return '';
    }

    public function offsetSet($offset, $value): void
    {
        //return '';
    }

    public function offsetUnset($offset): void
    {
        // TODO
    }



    // public function offsetExists($offset)
    // {
    //     // return isset($this->container[$offset]);
    // }

    // public function offsetUnset($offset)
    // {
    //     // TODO
    // }

    // public function offsetGet($offset)
    // {
    //     // return isset($this->container[$offset]) ? $this->container[$offset] : null;
    // }
}
