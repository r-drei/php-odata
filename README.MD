# rdrei/odata
![travis-ci](https://travis-ci.org/r-drei/php-odata.svg?branch=master)
[![Latest Stable Version](https://poser.pugx.org/rdrei/odata/v/stable)](https://packagist.org/packages/rdrei/odata)
[![Total Downloads](https://poser.pugx.org/rdrei/odata/downloads)](https://packagist.org/packages/rdrei/odata)
[![License](https://poser.pugx.org/rdrei/odata/license)](https://packagist.org/packages/rdrei/odata)

A small PHP OData Client based on [guzzlehttp](https://github.com/guzzle/guzzles).   

## Install
```bash
    composer require rdrei/odata
```

## Usage

Import the ODataClient
```php
    use \rdrei\odata\ODataClient;
    use \rdrei\odata\ODataQuery;
```

Create a ODataClient and a EntityHandler.
```php
    $client = new ODataClient([
        'url' => "https://<odata-server>/"
    ]);

    $entityHandler = $client->CreateHandler("EntityName");
```

### Get
Get Enitities with a Query.
```php
    $query = new ODataQuery();
    $query = $query->skip(0)->take(10);
    
    $result = $entityHandler->Get($query);
```

### Insert
Create a new Entity.
```php
    $entityHandler->Insert($entity);
```

### Update
Patch a Entity.
```php
    $entityHandler->Update($key, $entity);
```

### Delete
Remove a Entity by Key.
```php
    $entityHandler->Delete($key);
```


## Run Test
```bash
    git clone ...
    composer install
    ./vendor/bin/phpunit
```

## Documentation and Ressources
* [OData.org](http://www.odata.org)
* [OData v4 Reference Services (R/W)](https://services.odata.org/v4/(S(vuvl2lo1td4r1lzfpne2zqlz))/TripPinServiceRW/$metadata')
