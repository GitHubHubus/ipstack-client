<?php

namespace OK\Ipstack\Entity;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Location
{
    /**
     * @var string
     */
    protected $city;
    
    /**
     * @var string
     */
    protected $continentCode;
    
    /**
     * @var string
     */
    protected $continentName;
    
    /**
     * @var string
     */
    protected $countryCode;
    
    /**
     * @var string
     */
    protected $countryName;
    
    /**
     * @var string
     */
    protected $regionCode;
    
    /**
     * @var string
     */
    protected $regionName;
    
    /**
     * @var string
     */
    protected $zip;
    
    /**
     * @var float
     */
    protected $latitude;
    
    /**
     * @var float
     */
    protected $longitude;
    
    /**
     * @var string
     */
    protected $ip;
    
    /**
     * @var valid
     */
    protected $valid;
    
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }
    
    /**
     * @param bool $valid
     * @return Location
     */
    public function setValid(bool $valid): Location
    {
        $this->valid = $valid;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }
    
    /**
     * @param string $ip
     * @return Location
     */
    public function setIp(string $ip): Location
    {
        $this->ip = $ip;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
    
    /**
     * @param string $city
     * @return Location
     */
    public function setCity(string $city): Location
    {
        $this->city = $city;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getContinentCode(): string
    {
        return $this->continentCode;
    }

    /**
     * @param string $continentCode
     * @return Location
     */
    public function setContinentCode(string $continentCode): Location
    {
        $this->continentCode = $continentCode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getContinentName(): string
    {
        return $this->continentName;
    }

    /**
     * @param string $continentName
     * @return Location
     */
    public function setContinentName(string $continentName): Location
    {
        $this->continentName = $continentName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return Location
     */
    public function setCountryCode(string $countryCode): Location
    {
        $this->countryCode = $countryCode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param string $countryName
     * @return Location
     */
    public function setCountryName(string $countryName): Location
    {
        $this->countryName = $countryName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getRegionCode()
    {
        return $this->regionCode;
    }

    /**
     * @param string $regionCode
     * @return Location
     */
    public function setRegionCode(string $regionCode): Location
    {
        $this->regionCode = $regionCode;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getRegionName()
    {
        return $this->regionName;
    }

    /**
     * @param string $regionName
     * @return Location
     */
    public function setRegionName(string $regionName): Location
    {
        $this->regionName = $regionName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return Location
     */
    public function setZip(string $zip): Location
    {
        $this->zip = $zip;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return Location
     */
    public function setLatitude(float $latitude): Location
    {
        $this->latitude = $latitude;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return Location
     */
    public function setLongitude(float $longitude): Location
    {
        $this->longitude = $longitude;
        
        return $this;
    }
}
