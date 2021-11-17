<?php

namespace OK\Ipstack\Provider;

use OK\Ipstack\Entity\Dto\DtoInterface;
use OK\Ipstack\Entity\Dto\Location;
use OK\Ipstack\Entity\Params\IpapiParams;
use OK\Ipstack\Exceptions\InvalidApiException;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Ipapi extends Ipstack
{
    protected static $url = 'api.ipapi.com';
    private IpapiParams $params;

    public function __construct(string $key)
    {
        $this->params = new IpapiParams($key);
    }

    /**
     * @throws InvalidApiException
     */
    public function getDto(string $ip): DtoInterface
    {
        $data = $this->get($ip);

        return $this->createLocation($data);
    }
    
    /**
     * @throws InvalidApiException
     */
    public function getDtoBulk(array $ips): array
    {
        $result = $this->getBulk($ips);

        foreach ($result as $key => $locationData) {
            $result[$key] = $this->createLocation($locationData);
        }

        return $result;
    }

    public function getUrl(string $ip): string
    {
        return sprintf(
            '%s://%s/%s?access_key=%s&fields=%s&language=%s&output=%s&hostname=%s&security=%s',
            $this->params->getProtocol(),
            self::$url,
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
}
