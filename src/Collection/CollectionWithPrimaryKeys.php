<?php

namespace PlacetoPay\DocumentTypes\Collection;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use PlacetoPay\DocumentTypes\Support\HasPrimaryKey;

abstract class CollectionWithPrimaryKeys extends Collection
{
    /**
     * Get a dictionary keyed by primary keys.
     *
     * @param \ArrayAccess|array|null $items
     * @return array
     */
    public function getDictionary($items = null)
    {
        $items = is_null($items) ? $this->items : $items;

        $dictionary = [];

        foreach ($items as $value) {
            $dictionary[$value->getKey()] = $value;
        }

        return $dictionary;
    }

    /**
     * Determine if a key exists in the collection.
     *
     * @param mixed $key
     * @param mixed $operator
     * @param mixed $value
     * @return bool
     */
    public function contains($key, $operator = null, $value = null)
    {
        if (func_num_args() > 1 || $this->useAsCallable($key)) {
            return parent::contains(...func_get_args());
        }

        return parent::contains(function (HasPrimaryKey $item) use ($key) {
            return $item->getKey() === $key;
        });
    }

    /**
     * Returns only the models from the collection with the specified keys.
     *
     * @param mixed $keys
     * @return static
     */
    public function only($keys)
    {
        if (is_null($keys)) {
            return new static($this->items);
        }

        $dictionary = Arr::only($this->getDictionary(), $keys);

        return new static(array_values($dictionary));
    }

    /**
     * Returns all models in the collection except the models with specified keys.
     *
     * @param $keys
     * @return static
     */
    public function except($keys)
    {
        $dictionary = Arr::except($this->getDictionary(), $keys);

        return new static(array_values($dictionary));
    }

    /**
     * Find a model in the collection by key.
     *
     * @param mixed $key
     * @param mixed $default
     * @return static
     */
    public function find($key, $default = null)
    {
        if ($key instanceof HasPrimaryKey) {
            $key = $key->getKey();
        }

        if ($key instanceof Arrayable) {
            $key = $key->toArray();
        }

        if (is_array($key)) {
            if ($this->isEmpty()) {
                return new static;
            }

            return $this->whereIn($this->first()->getKeyName(), $key);
        }

        return Arr::first($this->items, function (HasPrimaryKey $item) use ($key) {
            return $item->getKey() == $key;
        }, $default);
    }
}
