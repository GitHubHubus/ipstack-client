[![Latest Stable Version](https://poser.pugx.org/ok/ipstack-client/version)](https://packagist.org/packages/ok/ipstack-client)
[![Total Downloads](https://poser.pugx.org/ok/ipstack-client/downloads)](https://packagist.org/packages/ok/ipstack-client)
[![License](https://poser.pugx.org/ok/ipstack-client/license)](https://packagist.org/packages/ok/ipstack-client)

# ipstack-client
A PHP wrapper for using Ipstack [API](https://ipstack.com/)

#### Install via `composer`:
```sh
composer require ok/ipstack-client
```

#### Basic usage

Get data as the [Location](https://github.com/GitHubHubus/ipstack-client/blob/master/src/OK/Ipstack/Entity/Location.php) object:
```php
$client = new OK\Ipstack\Client('api_key');
$location = $client->get('134.201.250.155', false);
var_dump($location);
```
result:
```php
class OK\Ipstack\Entity\Location#3 (12) {
  protected $city =>
  string(11) "Los Angeles"
  protected $continentCode =>
  string(2) "NA"
  protected $continentName =>
  string(13) "North America"
  protected $countryCode =>
  string(2) "US"
  protected $countryName =>
  string(13) "United States"
  protected $regionCode =>
  string(2) "CA"
  protected $regionName =>
  string(10) "California"
  protected $zip =>
  string(5) "90026"
  protected $latitude =>
  double(34.0766)
  protected $longitude =>
  double(-118.2646)
  protected $ip =>
  string(15) "134.201.250.155"
  protected $valid =>
  bool(true)
}
```

Get data as a simple array:
```php
$client = new OK\Ipstack\Client('api_key');
$location = $client->get('134.201.250.155');
var_dump($location);
```
result:
```php
array(13) {
  'ip' =>
  string(15) "134.201.250.155"
  'type' =>
  string(4) "ipv4"
  'continent_code' =>
  string(2) "NA"
  'continent_name' =>
  string(13) "North America"
  'country_code' =>
  string(2) "US"
  'country_name' =>
  string(13) "United States"
  'region_code' =>
  string(2) "CA"
  'region_name' =>
  string(10) "California"
  'city' =>
  string(11) "Los Angeles"
  'zip' =>
  string(5) "90026"
  'latitude' =>
  string(7) "34.0766"
  'longitude' =>
  string(9) "-118.2646"
  'location' =>
  array(8) {
    'geoname_id' =>
    string(7) "5368361"
    'capital' =>
    string(15) "Washington D.C."
    'languages' =>
    array(3) {
      'code' =>
      string(2) "en"
      'name' =>
      string(7) "English"
      'native' =>
      string(7) "English"
    }
    'country_flag' =>
    string(38) "http://assets.ipstack.com/flags/us.svg"
    'country_flag_emoji' =>
    string(8) "🇺🇸"
    'country_flag_emoji_unicode' =>
    string(15) "U+1F1FA U+1F1F8"
    'calling_code' =>
    string(1) "1"
    'is_eu' =>
    array(0) {
    }
  }
}
```

## Information

#### Modifiable output params
Available [params](https://github.com/GitHubHubus/ipstack-client/blob/master/src/OK/Ipstack/Entity/Params/IpstackParams.php) for getting custom result

For example:
```php
$client = new OK\Ipstack\Client('api_key');
$client->getParams()->addField("calling_code");
```

#### Data providers
Now, here are available several providers: 
* [TYPE_IPSTACK](https://ipstack.com/)
* [TYPE_IPAPI](https://ipapi.com/)
 
You can change provider by pass one of type above as second argument in constructor

For example:
```php
$client = new OK\Ipstack\Client('api_key', OK\Ipstack\Provider\ProviderFactory::TYPE_IPAPI);
```
