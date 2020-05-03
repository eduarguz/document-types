<?php

namespace PlacetoPay\DocumentTypes\Collection;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use PlacetoPay\DocumentTypes\Collection\CollectionWithPrimaryKeys;
use PlacetoPay\DocumentTypes\Entities\DocumentTypesByCountry;

class DocumentTypesByCountryCollection extends CollectionWithPrimaryKeys
{
    /**
     * Put an item first, the item is identified by its primary key.
     *
     * @param string $key
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypesByCountryCollection
     */
    public function putFirst(string $key): DocumentTypesByCountryCollection
    {
        $items = $this
            ->sortBy(function (DocumentTypesByCountry $group) use ($key) {
                return $group->getKey() === $key ? 1 : 2;
            })
            ->values();

        return new static($items);
    }
}
