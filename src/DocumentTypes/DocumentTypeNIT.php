<?php

namespace PlacetoPay\DocumentTypes\DocumentTypes;

class DocumentTypeNIT implements DocumentType
{
    private $country = 'CO';
    private $validationPattern = '/^[1-9][0-9]{4,9}$/';
    private $jsValidationPattern = '//';
    private $isBusinessDocument = false;

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getValidationPattern(): string
    {
        return $this->validationPattern;
    }

    /**
     * @return string
     */
    public function getJsValidationPattern(): string
    {
        return $this->jsValidationPattern;
    }

    /**
     * @return bool
     */
    public function isBusinessDocument(): bool
    {
        return $this->isBusinessDocument;
    }
}
