<?php


namespace PlacetoPay\DocumentTypes;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CountryGroupedDocumentTypeCollection extends Collection
{
    const PRIMARY_KEY = 'country';

    /**
     * Get a dictionary keyed by primary keys.
     *
     * @param  \ArrayAccess|array|null  $items
     * @return array
     */
    public function getDictionary($items = null)
    {
        $items = is_null($items) ? $this->items : $items;

        $dictionary = [];

        foreach ($items as $value) {
            $dictionary[$value[self::PRIMARY_KEY]] = $value;
        }

        return $dictionary;
    }

    public function putFirst(string $country)
    {
        $items = $this
            ->sortBy(function (array $group) use ($country) {
                return $group['country'] === $country ? 1 : 2;
            })
            ->values();

        return new static($items);
    }

    /**
     * Determine if a key exists in the collection.
     *
     * @param  mixed  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return bool
     */
    public function contains($key, $operator = null, $value = null)
    {
        if (func_num_args() > 1 || $this->useAsCallable($key)) {
            return parent::contains(...func_get_args());
        }

        return parent::contains(function (array $item) use ($key) {
            return $item[self::PRIMARY_KEY] === $key;
        });
    }

    /**
     * Returns only the models from the collection with the specified keys.
     *
     * @param mixed $keys
     * @return \PlacetoPay\DocumentTypes\CountryGroupedDocumentTypeCollection
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
     * @return \PlacetoPay\DocumentTypes\CountryGroupedDocumentTypeCollection
     */
    public function except($keys)
    {
        $dictionary = Arr::except($this->getDictionary(), $keys);

        return new static(array_values($dictionary));
    }
}
