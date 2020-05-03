<?php

namespace PlacetoPay\DocumentTypes\Entities;

class Document
{
    /**
     * @var string
     */
    private $document;

    /**
     * @var \PlacetoPay\DocumentTypes\Entities\DocumentType
     */
    private $documentType;

    public function __construct(string $document, DocumentType $documentType)
    {
        if (! $documentType->validate($document)) {
            throw new \DomainException(
                sprintf('Document "%s" does not pass validation against DocumentType "%s"', $document, $documentType->getCode())
            );
        }
    }
}
