<?php

namespace PlacetoPay\DocumentTypes\Collection;

use Illuminate\Support\Collection;
use PlacetoPay\DocumentTypes\Collection\CollectionWithPrimaryKeys;
use PlacetoPay\DocumentTypes\Collection\DocumentTypesByCountryCollection;
use PlacetoPay\DocumentTypes\Entities\DocumentTypesByCountry;
use PlacetoPay\DocumentTypes\DocumentTypesDataProvider;

class DocumentTypeCollection extends CollectionWithPrimaryKeys
{
    /**
     * Create a new instance using a known data provider
     *
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    public static function create(): DocumentTypeCollection
    {
        return new self((new DocumentTypesDataProvider())->all());
    }

    /**
     * Group document types by country and return a new collection.
     *
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypesByCountryCollection
     */
    public function groupByCountry(): DocumentTypesByCountryCollection
    {
        $items = $this
            ->groupBy('country')
            ->map(function (DocumentTypeCollection $documentTypes, string $country){
                return new DocumentTypesByCountry($country, $documentTypes);
            })
            ->values();

        return new DocumentTypesByCountryCollection($items);
    }

    /**
     * Return all entities in the collection except the entities with specified country.
     *
     * @param $keys
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    public function exceptByCountry($keys): DocumentTypeCollection
    {
        $response = $this->groupByCountry()
            ->except($keys)
            ->pluck('documentTypes')
            ->flatten(1);

        return new static($response->values());
    }

    /**
     * Return only the entities from the collection with the specified countries.
     *
     * @param mixed $keys
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    public function onlyByCountry($keys): DocumentTypeCollection
    {
        $response = $this->groupByCountry()
            ->only($keys)
            ->pluck('documentTypes')
            ->flatten(1);

        return new static(array_values($response->all()));
    }
}