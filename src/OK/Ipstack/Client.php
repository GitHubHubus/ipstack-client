<?php

namespace OK\Ipstack;

use OK\Ipstack\Exception\InvalidApiException;
use OK\Ipstack\Entity\Location;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Client
{
    const URL = 'api.ipstack.com';
    
    /**
     * @var string
     */
    private $protocol;
    
    /**
     * @var string 
     */
    private $key;

    /**
     * @var array
     */
    private $fields;
    
    /**
     * @var string 
     */
    private $language;
    
    /**
     * @param string $key <p>API Access Key</p>
     * @param string $protocol <p>http or https</p>
     * @param array $fields <p>The full list of fields look at https://ipstack.com/documentation</p>
     * @param string $language <p>The full list of language look at https://ipstack.com/documentation</p>
     *
     * @throws InvalidApiException
     */
    public function __construct($key = null, string $protocol = 'http', array $fields = ['main'], string $language = 'en')
    {
        if ($key === null) {
            throw new InvalidApiException('You have not API Access Key');
        }
        
        if (!in_array($protocol, ['http', 'https'])) {
            throw new \Exception('Incorrect protocol');
        }
        
        $this->key = $key;
        $this->protocol = $protocol;
        $this->fields = $fields;
        $this->language = $language;
    }
    
    /**
     * @param string $language
     * @return void
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }
    
    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }
    
    /**
     * @param string $field
     * @return void
     */
    public function addField(string $field): void
    {
        if (!in_array($field, $this->fields)) {
            $this->fields[] = $field;
        }
    }
    
    /**
     * @param string $field
     * @return void
     */
    public function removeField(string $field): void
    {
        if (in_array($field, $this->fields)) {
            unset($this->fields[$field]);
        }
    }
    
    /**
     * @param array $fields
     * @return void
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }
    
    /**
     * @return void
     */
    public function clearFields(): void
    {
        $this->fields = [];
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
     *
     * @param string $ip
     * @return string
     */
    public function getUrl(string $ip): string
    {
        return sprintf(
            '%s://%s/%s?access_key=%s&fields=%s&language=%s',
            $this->protocol,
            self::URL,
            $ip,
            $this->key,
            implode(',', $this->fields),
            $this->language
        );
    }
    
    /**
     * @param array $data
     * 
     * @return Location
     */
    private function createLocation($data): Location
    {
        $location = new Location();

        $location->setCity($data['city'] ?? null)
                ->setContinentCode($data['continent_code'] ?? null)
                ->setContinentName($data['continent_name'] ?? null)
                ->setCountryCode($data['country_code'] ?? null)
                ->setCountryName($data['country_name'] ?? null)
                ->setLatitude($data['latitude'] ?? null)
                ->setLongitude($data['longitude'] ?? null)
                ->setRegionCode($data['region_code'] ?? null)
                ->setRegionName($data['region_name'] ?? null)
                ->setZip($data['zip'] ?? null)
                ->setIp($data['ip'] ?? null)
                ->setValid((isset($data['type']) && $data['type'] !== null));
        
        return $location;
    }
}

