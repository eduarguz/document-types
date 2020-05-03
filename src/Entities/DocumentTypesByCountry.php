<?php

namespace PlacetoPay\DocumentTypes\Entities;

use PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection;
use PlacetoPay\DocumentTypes\Support\HasPrimaryKey;
use PlacetoPay\DocumentTypes\Support\ImmutableObjectAsArrayAccess;

class DocumentTypesByCountry implements HasPrimaryKey, \ArrayAccess
{
    use ImmutableObjectAsArrayAccess;

    /**
     * @var string
     */
    private $country;

    /**
     * @var \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    private $documentTypes;

    /**
     * DocumentTypesByCountry constructor.
     * @param string $country
     * @param \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection $documentTypes
     */
    public function __construct(string $country, DocumentTypeCollection $documentTypes)
    {
        $this->country = $country;
        $this->documentTypes = $documentTypes;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getCountry();
    }

    /**
     * @return string
     */
    public function getKeyName(): string
    {
        return 'country';
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return \PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection
     */
    public function getDocumentTypes(): DocumentTypeCollection
    {
        return $this->documentTypes;
    }
}
