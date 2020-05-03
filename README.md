# What Can I DO

```php
use PlacetoPay\DocumentTypes\Collection\DocumentTypeCollection;
    
$documentTypes = DocumentTypeCollection::create();

// Check if item is in collection
$documentTypes->contains('CC');
$documentTypes->contains('code', '==', 'CC');
$documentTypes->contains(function (array $documentType) { return $documentType['code'] === 'CC';});

// exclude items from collection
$documentTypes->except('CC');
$documentTypes->except(['CC', 'TI']);

// select items from collection
$documentTypes->only('CC');
$documentTypes->only(['CC', 'TI']);

// exclude items from collection
$documentTypes->exceptByCountry('CO');
$documentTypes->except(['CO', 'US']);

// select items from collection
$documentTypes->onlyByCountry('US');
$documentTypes->onlyByCountry(['US', 'EC']);

// Use the document type
$documentType = $documentTypes->find('CC');
$documentType['code'];
$documentType['country'];
$documentType['pattern'];
$documentType['javascript_pattern'];
$documentType['is_business'];

// group by country
$byCountry = $documentTypes->groupByCountry();

// put a country first
$byCountry->putFirst('CO');

// exclude country from collection
$byCountry->except('CO');
$byCountry->except(['CO', 'US']);

// select country from collection
$byCountry->only('CO');
$byCountry->only(['CO', 'US']);




// Ideas


```
