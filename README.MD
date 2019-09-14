# rdrei/odata

A small PHP OData Client 

## Install

*comming soon*
```bash
    composer require rdrei/odata
```

## Usage
Create a ODataClient and a EntityHandler.
```php
    $client = new \rdrei\odata\ODataClient(['url' => "https://services.odata.org/TripPinRESTierService"]);
    $entityHandler = $client->CreateHandler("People");
```

### Get
Get Enitities with a Query.
```php
    $query = new \rdrei\odata\ODataQuery();
    $query = $query->skip(0)->take(10);
    $result = $entityHandler->Get($query);
```

### Insert
Add a new Entity.
```php
    $entityHandler->Insert($people);
```

### Update
Change a Entity.
```php
    $entityHandler->Update($key, $people);
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

