<?php

namespace PlacetoPay\DocumentTypes\Support;

use RuntimeException;

trait ImmutableObjectAsArrayAccess
{
    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return ! is_null($this->$offset);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('Attempt to mutate immutable ' . __CLASS__ . ' object.');
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        throw new RuntimeException('Attempt to mutate immutable ' . __CLASS__ . ' object.');
    }
}
