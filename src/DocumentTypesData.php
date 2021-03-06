<?php

namespace PlacetoPay\DocumentTypes;

use OutOfBoundsException;
use PlacetoPay\DocumentTypes\Entities\DocumentType;
use PlacetoPay\DocumentTypes\Entities\DocumentTypeCode;

class DocumentTypesData
{
    const KEY_CODE = 'code';

    /**
     * Document Types Library.
     * @var array[]
     */
    private $documentTypes = [
        [
            'code' => DocumentTypeCode::CC,
            'country' => 'CO',
            'pattern' => '/^[1-9][0-9]{3,9}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::CE,
            'country' => 'CO',
            'pattern' => '/^([a-zA-Z]{1,5})?[1-9][0-9]{3,7}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::TI,
            'country' => 'CO',
            'pattern' => '/^[1-9][0-9]{4,11}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::RC,
            'country' => 'CO',
            'pattern' => '//',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::NIT,
            'country' => 'CO',
            'pattern' => '/^[1-9]\d{6,9}$/',
            'javascriptPattern' => '',
            'isBusiness' => true,
        ],
        [
            'code' => DocumentTypeCode::RUT,
            'country' => 'CO',
            'pattern' => '/^[1-9]\d{6,9}$/',
            'javascriptPattern' => '',
            'isBusiness' => true,
        ],
        [
            'code' => DocumentTypeCode::PPN,
            'country' => 'GLOBAL',
            'pattern' => '/^[a-zA-Z0-9_]{4,16}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::TAX,
            'country' => 'GLOBAL',
            'pattern' => '/^[a-zA-Z0-9_]{4,16}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::LIC,
            'country' => 'GLOBAL',
            'pattern' => '/^[a-zA-Z0-9_]{4,16}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::CD,
            'country' => 'GLOBAL',
            'pattern' => '//',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::SSN,
            'country' => 'US',
            'pattern' => '/^\d{3}\d{2,3}\d{4}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::CIP,
            'country' => 'PA',
            'pattern' => '/^(PE|N|E|\d+)?\d{2,6}\d{2,6}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::CPF,
            'country' => 'BR',
            'pattern' => '/^\d{10,11}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::CI,
            'country' => 'EC',
            'pattern' => '/^\d{10}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
        [
            'code' => DocumentTypeCode::RUC,
            'country' => 'EC',
            'pattern' => '/^\d{13}$/',
            'javascriptPattern' => '',
            'isBusiness' => true,
        ],
        [
            'code' => DocumentTypeCode::DNI,
            'country' => 'PE',
            'pattern' => '/^\d{8}$/',
            'javascriptPattern' => '',
            'isBusiness' => false,
        ],
    ];

    /**
     * Maps document types into DocumentType Class.
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

    public static function fromCode(string $code)
    {
        $item = (new static())->lookup($code);

        return new DocumentType(
            $item['code'],
            $item['country'],
            $item['pattern'],
            $item['javascriptPattern'],
            $item['isBusiness'],
        );
    }

    private function lookup(string $code)
    {
        foreach ($this->documentTypes as $documentType) {
            if ($documentType[self::KEY_CODE] === $code) {
                return $documentType;
            }
        }

        throw new OutOfBoundsException(
            sprintf('No "%s" key found matching: %s', self::KEY_CODE, $code)
        );
    }
}
