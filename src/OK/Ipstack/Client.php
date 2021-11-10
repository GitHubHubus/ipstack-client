<?php

namespace OK\Ipstack;

use OK\Ipstack\Exceptions\InvalidApiException;
use OK\Ipstack\Entity\Location;
use OK\Ipstack\Entity\ParameterBag;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Client
{
    const URL = 'api.ipstack.com';

    private ParameterBag $params;
    
    /**
     * @param string $key <p>API Access Key</p>
     *
     * @throws InvalidApiException
     */
    public function __construct(?string $key = null)
    {
        if ($key === null) {
            throw new InvalidApiException('You have not API Access Key');
        }
        
        $this->params = new ParameterBag($key);
    }

    /**
     * Get data by ip from api ipstack
     *
     * @return Location|array
     * @throws InvalidApiException
     */
    public function get(string $ip, bool $isArray = true)
    {
        $result = $this->request($this->getUrl($ip));
                    
        if (isset($result['error'])) {
            throw new InvalidApiException("[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}");
        }

        return $isArray ? $result : $this->createLocation($result);
    }
    
    /**
     * Get data by array ip's from api ipstack
     *
     * @return Location|array
     * @throws InvalidApiException
     */
    public function getBulk(array $ips, bool $isArray = false)
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
     * @throws InvalidApiException
     */
    private function request(string $url): array
    {
        $c = curl_init($url);

        if ($c === false) {
            throw new InvalidApiException("Can't init connection to $url");
        }

        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($c);
        curl_close($c);
        
        if ($this->params->getFormat() === ParameterBag::FORMAT_XML) {
            $xml = simplexml_load_string($response);
            $response = json_encode($xml);
        }
        
        return json_decode($response, true);
    }
    
    /**
     * Generate url with api key
     */
    public function getUrl(string $ip): string
    {
        return sprintf(
            '%s://%s/%s?access_key=%s&fields=%s&language=%s&output=%s&hostname=%s&security=%s',
            $this->params->getProtocol(),
            self::URL,
            $ip,
            $this->params->getKey(),
            implode(',', $this->params->getFields()),
            $this->params->getLanguage(),
            $this->params->getFormat(),
            (int)$this->params->isHostnameLookupEnabled(),
            (int)$this->params->isSecurityModuleEnabled()
        );
    }

    private function createLocation(array $data): Location
    {
        $location = new Location();

        $location->setCity($data['city'] ?? null)
                ->setHostname($data['hostname'] ?? null)
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
                ->setCallingCode($data['calling_code'] ?? null)
                ->setIsEu($data['isEu'] ?? null)
                ->setValid((isset($data['type']) && $data['type'] !== null));
        
        return $location;
    }

    public function getParams(): ParameterBag
    {
        return $this->params;
    }

    public function setParams(ParameterBag $params): void
    {
        $this->params = $params;
    }
}
