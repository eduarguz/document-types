<?php

namespace PlacetoPay\DocumentTypes\Collection;

use Illuminate\Support\Collection;
use PlacetoPay\DocumentTypes\Collection\CollectionWithPrimaryKeys;
use PlacetoPay\DocumentTypes\Collection\DocumentTypesByCountryCollection;
use PlacetoPay\DocumentTypes\DocumentTypesData;
use PlacetoPay\DocumentTypes\Entities\DocumentTypesByCountry;

class DocumentTypeCollection extends CollectionWithPrimaryKeys
{
    /**
     * Create a new instance using a known data provider.
     *
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    public static function create(): self
    {
        return new self((new DocumentTypesData())->all());
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
            ->map(function (self $documentTypes, string $country) {
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
    public function exceptByCountry($keys): self
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
    public function onlyByCountry($keys): self
    {
        $response = $this->groupByCountry()
            ->only($keys)
            ->pluck('documentTypes')
            ->flatten(1);

        return new static(array_values($response->all()));
    }

    /**
     * Return only the documents that are for businesses.
     *
     * @param bool $value
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    public function onlyBusiness($value = true)
    {
        return $this->where('isBusiness', $value);
    }

    /**
     * Return only the documents that are not for businesses.
     *
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    public function onlyNotBusiness()
    {
        return $this->onlyBusiness(false);
    }
}
