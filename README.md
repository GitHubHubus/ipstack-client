# ipstack-client
A PHP wrapper for using Ipstack API 

Install via `composer`:
```sh
composer require ok/ipstack-client
```

Basic usage:
```php
$client = new OK\Ipstack\Client('api_key');
$location = $client->get('134.201.250.155');
var_dump($location);
```
