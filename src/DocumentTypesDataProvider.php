<?php

namespace PlacetoPay\DocumentTypes;

use PlacetoPay\DocumentTypes\Entities\DocumentType;

class DocumentTypesDataProvider
{
    /**
     * Document Types Library
     * @var array[]
     */
    private $documentTypes = [
        [
            'code' => 'CC',
            'country' => 'CO',
            'pattern' => '/^[1-9][0-9]{3,9}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'CE',
            'country' => 'CO',
            'pattern' => '/^([a-zA-Z]{1,5})?[1-9][0-9]{3,7}$/',
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
            'code' => 'RC',
            'country' => 'CO',
            'pattern' => '//',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'NIT',
            'country' => 'CO',
            'pattern' => '/^[1-9]\d{6,9}$/',
            'javascriptPattern' => '',
            'isBusiness' => true,
        ],
        [
            'code' => 'RUT',
            'country' => 'CO',
            'pattern' => '/^[1-9]\d{6,9}$/',
            'javascriptPattern' => '',
            'isBusiness' => true,
        ],
        [
            'code' => 'PPN',
            'country' => 'GLOBAL',
            'pattern' => '/^[a-zA-Z0-9_]{4,16}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'TAX',
            'country' => 'GLOBAL',
            'pattern' => '/^[a-zA-Z0-9_]{4,16}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'LIC',
            'country' => 'GLOBAL',
            'pattern' => '/^[a-zA-Z0-9_]{4,16}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'CD',
            'country' => 'GLOBAL',
            'pattern' => '//',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'SSN',
            'country' => 'US',
            'pattern' => '/^\d{3}\d{2,3}\d{4}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'CIP',
            'country' => 'PA',
            'pattern' => '/^(PE|N|E|\d+)?\d{2,6}\d{2,6}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'CPF',
            'country' => 'BR',
            'pattern' => '/^\d{10,11}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'CI',
            'country' => 'EC',
            'pattern' => '/^\d{10}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => 'RUC',
            'country' => 'EC',
            'pattern' => '/^\d{13}$/',
            'javascriptPattern' => '',
            'isBusiness' => true,
        ],
        [
            'code' => 'DNI',
            'country' => 'PE',
            'pattern' => '/^\d{8}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
    ];

    /**
     * Maps document types into DocumentType Class
     *
     * @return \PlacetoPay\DocumentTypes\Entities\DocumentType[]
     */
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
