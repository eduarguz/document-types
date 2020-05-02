<?php

namespace PlacetoPay\DocumentTypes\Tests;

use PlacetoPay\DocumentTypes\CountryGroupedDocumentTypeCollection;
use PlacetoPay\DocumentTypes\DocumentType;
use PlacetoPay\DocumentTypes\DocumentTypeCollection;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @test **/
    public function can_create_collection()
    {
        $collection = DocumentTypeCollection::create();
        $this->assertNotEmpty($collection);
        $this->assertInstanceOf(DocumentTypeCollection::class, $collection);
        $this->assertContainsOnlyInstancesOf(DocumentType::class, $collection);
    }

    /** @test **/
    public function checks_if_collection_contains_an_item()
    {
        $this->assertTrue(DocumentTypeCollection::create()->contains('CC'));
        $this->assertFalse(DocumentTypeCollection::create()->contains('XX'));

        $this->assertTrue(DocumentTypeCollection::create()->contains(function (DocumentType $documentType) {
            return $documentType->getCode() === 'CC';
        }));

        $this->assertFalse(DocumentTypeCollection::create()->contains(function (DocumentType $documentType) {
            return $documentType->getCode() === 'XX';
        }));

        $this->assertFalse(DocumentTypeCollection::create()->contains('code', 'XX'));
        $this->assertTrue(DocumentTypeCollection::create()->contains('code', 'CC'));

        $this->assertFalse(DocumentTypeCollection::create()->contains('code', '==', 'XX'));
        $this->assertTrue(DocumentTypeCollection::create()->contains('code', '==', 'CC'));
    }

    /** @test **/
    public function can_remove_items_by_country_code()
    {
        $result = DocumentTypeCollection::create()->exceptByCountry('CO');
        $this->assertFalse($result->contains('CC'));
        $this->assertTrue($result->contains('DNI'));

        $result = DocumentTypeCollection::create()->exceptByCountry(['CO', 'US']);
        $this->assertFalse($result->contains('CC'));
        $this->assertFalse($result->contains('DNI'));
        $this->assertTrue($result->contains('PPN'));
    }

    /** @test **/
    public function can_select_items_by_country_code()
    {
        $result = DocumentTypeCollection::create()->onlyByCountry('CO');
        $this->assertTrue($result->contains('CC'));
        $this->assertFalse($result->contains('DNI'));

        $result = DocumentTypeCollection::create()->onlyByCountry(['CO', 'US']);
        $this->assertTrue($result->contains('CC'));
        $this->assertTrue($result->contains('DNI'));
        $this->assertFalse($result->contains('PPN'));
    }

    /** @test **/
    public function can_select_items_by_code()
    {
        $result = DocumentTypeCollection::create()->only('CC');
        $this->assertTrue($result->contains('CC'));
        $this->assertCount(1, $result);

        $result = DocumentTypeCollection::create()->only(['CC', 'TI']);
        $this->assertTrue($result->contains('CC'));
        $this->assertTrue($result->contains('TI'));
        $this->assertCount(2, $result);
    }

    /** @test **/
    public function can_find_items()
    {
        $result = DocumentTypeCollection::create()->find('CC');
        $this->assertEquals('CC', $result['code']);

        $result = DocumentTypeCollection::create()->find(['CC', 'TI']);
        $this->assertTrue($result->contains('CC'));
        $this->assertTrue($result->contains('TI'));
        $this->assertCount(2, $result);
    }

    /** @test **/
    public function can_group_by_country()
    {
        $result = DocumentTypeCollection::create()->groupByCountry();
        $this->assertInstanceOf(CountryGroupedDocumentTypeCollection::class, $result);
        $this->assertCount(3, $result);
    }

    /** @test **/
    public function can_set_a_country_first()
    {
        $result = DocumentTypeCollection::create()->groupByCountry()->putFirst('US');
        $this->assertEquals('US', $result->first()->getCountry());

        $result = DocumentTypeCollection::create()->groupByCountry()->putFirst('CO');
        $this->assertEquals('CO', $result->first()->getCountry());
    }

    /** @test **/
    public function can_select_items_by_country_code_in_documents()
    {
        $result = DocumentTypeCollection::create()->groupByCountry()->only('US');
        $this->assertTrue($result->contains('US'));
        $this->assertCount(1, $result);


        $result = DocumentTypeCollection::create()->groupByCountry()->only(['CO', 'US']);
        $this->assertTrue($result->contains('US'));
        $this->assertTrue($result->contains('CO'));
        $this->assertCount(2, $result);
    }

    /** @test **/
    public function can_exclude_items_by_country_code()
    {
        $result = DocumentTypeCollection::create()->groupByCountry()->except('US');
        $this->assertFalse($result->contains('US'));
        $this->assertTrue($result->contains('CO'));

        $result = DocumentTypeCollection::create()->groupByCountry()->except(['CO', 'US']);
        $this->assertFalse($result->contains('US'));
        $this->assertFalse($result->contains('CO'));
    }
}
