<?php

namespace PlacetoPay\DocumentTypes;

class DocumentTypesDataProvider
{
    private $documentTypes = [
        [
            'code' => 'CC',
            'country' => 'CO',
            'pattern' => '/^[1-9][0-9]{4,9}$/',
            'javascript_pattern' => '',
            'is_business' => false,
        ],
        [
            'code' => 'TI',
            'country' => 'CO',
            'pattern' => '/^[1-9][0-9]{4,11}$/',
            'javascript_pattern' => '',
            'is_business' => false,
        ],
        [
            'code' => 'DNI',
            'country' => 'US',
            'pattern' => '/^[1-9][0-9]{4,11}$/',
            'javascript_pattern' => '',
            'is_business' => false,
        ],
        [
            'code' => 'PPN',
            'country' => 'EC',
            'pattern' => '/^[1-9][0-9]{4,11}$/',
            'javascript_pattern' => '',
            'is_business' => false,
        ],
    ];

    public function all()
    {
        return $this->documentTypes;
    }
}
