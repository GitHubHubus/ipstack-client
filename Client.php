<?php

namespace OK\Ipstack;

use OK\Ipstack\Exception\InvalidApiException;
use OK\Ipstack\Entity\Location;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Client
{
    const URL = 'http://api.ipstack.com/';
    
    /**
     * @var string 
     */
    private $key;
    
    public function __construct($key = null)
    {
        if ($key === null) {
            throw new InvalidApiException('You have not API Access Key');
        }
        
        $this->key = $key;
    }
    
    /**
     * Get data by ip from api ipstack
     * @param string $ip
     * @param bool $isArray
     *
     * @return mixed
     */
    public function get(string $ip, $isArray = false)
    {
        $url = URL . $ip . '?access_key=' . $this->key;
        
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($c);
        
        curl_close($c);
        
        $result = json_decode($json, true);
        
        if ($result['error']) {
            throw new InvalidApiException("[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}");
        }

        return $isArray ? $result : $this->createLocation($result);
    }
    
    /**
     * @param array $data
     * 
     * @return Location
     */
    private function createLocation($data): Location
    {
        $location = new Location();
        
        $location->setCity($data['city'])
                ->setContinentCode($data['continent_code'])
                ->setContinentName($data['continent_name'])
                ->setCountryCode($data['country_code'])
                ->setCountryName($data['country_name'])
                ->setLatitude($data['latitude'])
                ->setLongitude($data['longitude'])
                ->setRegionCode($data['region_code'])
                ->setRegionName($data['region_name'])
                ->setZip($data['zip']);
        
        return $location;
    }
}

