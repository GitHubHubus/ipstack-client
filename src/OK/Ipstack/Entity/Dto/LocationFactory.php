<?php

namespace OK\Ipstack\Entity\Dto;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class LocationFactory
{
    public function createArray(array $data): array
    {
        foreach ($data as $key => $locationData) {
            $data[$key] = $this->create($locationData);
        }

        return $data;
    }

    public function create(array $data): Location
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
