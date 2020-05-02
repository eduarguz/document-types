<?php

namespace PlacetoPay\DocumentTypes;

class DocumentTypesByCountry implements  HasPrimaryKey, \ArrayAccess
{
    use ImmutableObjectAsArrayAccess;

    /**
     * @var string
     */
    private $country;

    /**
     * @var \PlacetoPay\DocumentTypes\DocumentTypeCollection
     */
    private $documentTypes;

    /**
     * DocumentTypesByCountry constructor.
     * @param string $country
     * @param \PlacetoPay\DocumentTypes\DocumentTypeCollection $documentTypes
     */
    public function __construct(string $country, DocumentTypeCollection $documentTypes)
    {
        $this->country = $country;
        $this->documentTypes = $documentTypes;
    }

    public function getKey()
    {
        return $this->getCountry();
    }

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
}
