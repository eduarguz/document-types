<?php

namespace PlacetoPay\DocumentTypes;

class DocumentValidator
{
    public function isTypeValid(string $code)
    {
        try {
            return !!DocumentTypesData::fromCode($code);
        } catch (\OutOfBoundsException $e) {
            return false;
        }
    }

    public function isValid(string $document, string $documentTypeCode)
    {
        if (!$this->isTypeValid($documentTypeCode)){
            return false;
        }

        try {
            $documentType = DocumentTypesData::fromCode($documentTypeCode);
            return preg_match($documentType->getPattern(), $document) === 1;
        } catch (\OutOfBoundsException $e) {
            return false;
        }
    }
}
