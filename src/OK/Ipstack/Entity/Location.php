<?php

namespace OK\Ipstack\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Location
{
    protected ?string $city;
    protected ?string $hostname;
    protected ?string $continentCode;
    protected ?string $continentName;
    protected ?string $countryCode;
    protected ?string $countryName;
    protected ?string $regionCode;
    protected ?string $regionName;
    protected ?string $zip;
    protected ?float $latitude;
    protected ?float $longitude;
    protected ?string $ip;
    protected ?string $callingCode;
    protected ?bool $isEu;
    
    /**
     * Internal variable for checking the type of ip protocol is valid
     */
    protected bool $valid = true;

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): Location
    {
        $this->valid = $valid;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip = null): Location
    {
        $this->ip = $ip;

        return $this;
    }

    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    public function setHostname(?string $hostname = null): Location
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city = null): Location
    {
        $this->city = $city;

        return $this;
    }

    public function getContinentCode(): ?string
    {
        return $this->continentCode;
    }

    public function setContinentCode(?string $continentCode = null): Location
    {
        $this->continentCode = $continentCode;
        
        return $this;
    }

    public function getContinentName(): ?string
    {
        return $this->continentName;
    }

    public function setContinentName(?string $continentName = null): Location
    {
        $this->continentName = $continentName;
        
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode = null): Location
    {
        $this->countryCode = $countryCode;
        
        return $this;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(?string $countryName = null): Location
    {
        $this->countryName = $countryName;
        
        return $this;
    }

    public function getRegionCode(): ?string
    {
        return $this->regionCode;
    }

    public function setRegionCode(?string $regionCode = null): Location
    {
        $this->regionCode = $regionCode;
        
        return $this;
    }

    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    public function setRegionName(?string $regionName = null): Location
    {
        $this->regionName = $regionName;
        
        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip = null): Location
    {
        $this->zip = $zip;
        
        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude = null): Location
    {
        $this->latitude = $latitude;
        
        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude = null): Location
    {
        $this->longitude = $longitude;
        
        return $this;
    }

    public function getCallingCode(): ?string
    {
        return $this->callingCode;
    }

    public function setCallingCode(?string $code = null): Location
    {
        $this->callingCode = $code;
        
        return $this;
    }

    public function getIsEu(): ?bool
    {
        return $this->isEu;
    }

    public function setIsEu(?bool $eu = null): Location
    {
        $this->isEu = $eu;
        
        return $this;
    }
}
