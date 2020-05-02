<?php

namespace PlacetoPay\DocumentTypes;

class DocumentTypesDataProvider
{
    private $documentTypes = [
        [
            'code' => 'CC',
            'country' => 'CO',
            'pattern' => '/^[1-9][0-9]{4,9}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'TI',
            'country' => 'CO',
            'pattern' => '/^[1-9][0-9]{4,11}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'DNI',
            'country' => 'US',
            'pattern' => '/^[1-9][0-9]{4,11}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'PPN',
            'country' => 'EC',
            'pattern' => '/^[1-9][0-9]{4,11}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
    ];

    public function all()
    {
        return array_map(function (array $item) {
            return new DocumentType(
                $item['code'],
                $item['country'],
                $item['pattern'],
                $item['javascriptPattern'],
                $item['isBusiness'],
            );
        }, $this->documentTypes);
    }
}
