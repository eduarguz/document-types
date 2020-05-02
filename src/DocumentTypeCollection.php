<?php

namespace PlacetoPay\DocumentTypes;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DocumentTypeCollection extends Collection
{
    const PRIMARY_KEY = 'code';

    /**
     * self constructor
     * @return \PlacetoPay\DocumentTypes\DocumentTypeCollection
     */
    public static function create()
    {
        return new self((new DocumentTypesDataProvider())->all());
    }

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

        return parent::contains(function (array $documentType) use ($key) {
            return $documentType[self::PRIMARY_KEY] === $key;
        });
    }

    /**
     * Returns all models in the collection except the models with specified keys.
     *
     * @param $keys
     * @return \PlacetoPay\DocumentTypes\DocumentTypeCollection
     */
    public function except($keys)
    {
        $dictionary = Arr::except($this->getDictionary(), $keys);

        return new static(array_values($dictionary));
    }

    /**
     * Returns only the models from the collection with the specified keys.
     *
     * @param mixed $keys
     * @return \PlacetoPay\DocumentTypes\DocumentTypeCollection
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
     * @return \PlacetoPay\DocumentTypes\CountryGroupedDocumentTypeCollection
     */
    public function groupByCountry()
    {
        return new CountryGroupedDocumentTypeCollection(
            $this->groupBy('country')
                ->map(function (DocumentTypeCollection $documentTypes, string $country){
                    return ['country' => $country, 'documentTypes' => $documentTypes];
                })
                ->values()
        );
    }

    /**
     * Returns all models in the collection except the models with specified keys.
     *
     * @param $keys
     * @return \PlacetoPay\DocumentTypes\DocumentTypeCollection
     */
    public function exceptByCountry($keys)
    {
        $response = $this->groupByCountry()
            ->except($keys)
            ->pluck('documentTypes')
            ->flatten(1);

        return new static(array_values($response->all()));
    }

    /**
     * Returns only the models from the collection with the specified keys.
     *
     * @param mixed $keys
     * @return \PlacetoPay\DocumentTypes\DocumentTypeCollection
     */
    public function onlyByCountry($keys)
    {
        $response = $this->groupByCountry()
            ->only($keys)
            ->pluck('documentTypes')
            ->flatten(1);

        return new static(array_values($response->all()));
    }

    /**
     * Find a model in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $default
     * @return \PlacetoPay\DocumentTypes\DocumentTypeCollection
     */
    public function find($key, $default = null)
    {
        if ($key instanceof Arrayable) {
            $key = $key->toArray();
        }

        if (is_array($key)) {
            if ($this->isEmpty()) {
                return new static;
            }

            return $this->whereIn(self::PRIMARY_KEY, $key);
        }

        return Arr::first($this->items, function ($item) use ($key) {
            return $item[self::PRIMARY_KEY] == $key;
        }, $default);
    }
}
