<?php

namespace PlacetoPay\DocumentTypes\Entities;

use PlacetoPay\DocumentTypes\Support\HasPrimaryKey;
use PlacetoPay\DocumentTypes\Support\ImmutableObjectAsArrayAccess;

class DocumentType implements HasPrimaryKey, \ArrayAccess
{
    use ImmutableObjectAsArrayAccess;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @var string
     */
    private $javascriptPattern;

    /**
     * @var bool
     */
    private $isBusiness;

    /**
     * DocumentType constructor.
     * @param string $code
     * @param string $country
     * @param string $pattern
     * @param string $javascriptPattern
     * @param bool $isBusiness
     */
    public function __construct(string $code, string $country, string $pattern, string $javascriptPattern, bool $isBusiness)
    {
        $this->code = $code;
        $this->country = $country;
        $this->pattern = $pattern;
        $this->javascriptPattern = $javascriptPattern;
        $this->isBusiness = $isBusiness;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->getCode();
    }

    /**
     * @return string
     */
    public function getKeyName(): string
    {
        return 'code';
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

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
    public function getJavascriptPattern(): string
    {
        return $this->javascriptPattern;
    }

    /**
     * @return bool
     */
    public function getIsBusiness(): bool
    {
        return $this->isBusiness;
    }

    /**
     * @return bool
     */
    public function isBusiness(): bool
    {
        return $this->getIsBusiness();
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }
}
