<?php

namespace OK\Ipstack;

use OK\Ipstack\Exception\InvalidApiException;
use OK\Ipstack\Entity\Location;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Client
{
    const URL = 'api.ipstack.com/';
    
    /**
     * @var string
     */
    private $protocol;
    
    /**
     * @var string 
     */
    private $key;

    /**
     * @param string $key
     * @throws InvalidApiException
     */
    public function __construct($key = null, $protocol = 'http')
    {
        if ($key === null) {
            throw new InvalidApiException('You have not API Access Key');
        }
        
        if (!in_array($protocol, ['http', 'https'])) {
            throw new \Exception('Incorrect protocol');
        }
        
        $this->key = $key;
        $this->protocol = $protocol;
    }
    
    /**
     * Get data by ip from api ipstack
     *
     * @param string $ip
     * @param bool $isArray
     *
     * @return mixed
     */
    public function get(string $ip, $isArray = false)
    {
        $result = $this->request($this->getUrl($ip));
                    
        if ($result['error']) {
            throw new InvalidApiException("[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}");
        }

        return $isArray ? $result : $this->createLocation($result);
    }
    
    /**
     * Get data by array ip's from api ipstack
     *
     * @param array $ips
     * @param bool $isArray
     *
     * @return mixed
     */
    public function getBulk(array $ips, $isArray = false)
    {
        $result = $this->request($this->getUrl(implode(',', $ips)));
                    
        if ($result['error']) {
            throw new InvalidApiException("[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}");
        }

        if (!$isArray) {
            foreach ($result as $key => $locationData) {
                $result[$key] = $this->createLocation($locationData);
            }
        }

        return $result;
    }
    
    /**
     * @param string $url
     * 
     * @return array
     */
    private function request(string $url): array
    {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($c);
        curl_close($c);
        
        return json_decode($json, true);
    }
    
    /**
     * Generate url with api key
     * @param string $ip
     * @return string
     */
    public function getUrl(string $ip): string
    {
        return sprintf('%s://%s%s?access_key=', [$this->protocol, self::URL, $ip, $this->key]);
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
                ->setZip($data['zip'])
                ->setIp($data['ip'])
                ->setValid($data['type'] !== null);
        
        return $location;
    }
}

