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
     * @var string
     */
    protected $callingCode;
    
    /**
     * @var bool
     */
    protected $isEu;
    
    /**
     * Internal variable for checking that the type of ip protocol is valid
     *
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
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }
    
    /**
     * @param string|null $ip
     * @return Location
     */
    public function setIp(string $ip = null): Location
    {
        $this->ip = $ip;

        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }
    
    /**
     * @param string|null $city
     * @return Location
     */
    public function setCity(string $city = null): Location
    {
        $this->city = $city;

        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getContinentCode(): ?string
    {
        return $this->continentCode;
    }

    /**
     * @param string|null $continentCode
     * @return Location
     */
    public function setContinentCode(string $continentCode = null): Location
    {
        $this->continentCode = $continentCode;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getContinentName(): ?string
    {
        return $this->continentName;
    }

    /**
     * @param string|null $continentName
     * @return Location
     */
    public function setContinentName(string $continentName = null): Location
    {
        $this->continentName = $continentName;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @param string|null $countryCode
     * @return Location
     */
    public function setCountryCode(string $countryCode = null): Location
    {
        $this->countryCode = $countryCode;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    /**
     * @param string|null $countryName
     * @return Location
     */
    public function setCountryName(string $countryName = null): Location
    {
        $this->countryName = $countryName;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getRegionCode(): ?string
    {
        return $this->regionCode;
    }

    /**
     * @param string|null $regionCode
     * @return Location
     */
    public function setRegionCode(string $regionCode = null): Location
    {
        $this->regionCode = $regionCode;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    /**
     * @param string|null $regionName
     * @return Location
     */
    public function setRegionName(string $regionName = null): Location
    {
        $this->regionName = $regionName;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string|null $zip
     * @return Location
     */
    public function setZip(string $zip = null): Location
    {
        $this->zip = $zip;
        
        return $this;
    }
    
    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     * @return Location
     */
    public function setLatitude(float $latitude = null): Location
    {
        $this->latitude = $latitude;
        
        return $this;
    }
    
    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     * @return Location
     */
    public function setLongitude(float $longitude = null): Location
    {
        $this->longitude = $longitude;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getCallingCode(): ?string
    {
        return $this->callingCode;
    }

    /**
     * @param string|null $code
     * @return Location
     */
    public function setCallingCode(string $code = null): Location
    {
        $this->callingCode = $code;
        
        return $this;
    }
    
    /**
     * @return bool|null
     */
    public function getIsEu(): ?bool
    {
        return $this->isEu;
    }

    /**
     * @param bool|null $eu
     * @return Location
     */
    public function setIsEu(bool $eu = null): Location
    {
        $this->isEu = $eu;
        
        return $this;
    }
}
