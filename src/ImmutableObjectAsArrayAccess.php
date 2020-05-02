<?php


namespace PlacetoPay\DocumentTypes;


use RuntimeException;

trait ImmutableObjectAsArrayAccess
{
    public function offsetExists($offset)
    {
        return ! is_null($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('Attempt to mutate immutable ' . __CLASS__ . ' object.');
    }

    public function offsetUnset($offset)
    {
        throw new RuntimeException('Attempt to mutate immutable ' . __CLASS__ . ' object.');
    }
}
