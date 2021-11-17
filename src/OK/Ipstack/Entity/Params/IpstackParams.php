<?php

namespace OK\Ipstack\Entity\Params;

use OK\Ipstack\Exceptions\InvalidParameterException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class IpstackParams implements ParameterBagInterface
{
    use ParameterBagTrait;
    use FieldsTrait;

    protected bool $hostnameLookup = false;
    protected bool $securityModule = false;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getAvailableFields(): array
    {
        return [
            "main",
            "ip",
            "hostname",
            "type",
            "continent_code",
            "continent_name",
            "country_code",
            "country_name",
            "region_code",
            "region_name",
            "city",
            "zip",
            "latitude",
            "longitude",
            "location",
            "location.geoname_id",
            "location.capital",
            "location.languages",
            "location.languages.code",
            "location.languages.name",
            "native.location.languages",
            "country_flag",
            "country_flag_emoji",
            "country_flag_emoji_unicode",
            "calling_code",
            "is_eu"
        ];
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function isHostnameLookupEnabled(): bool
    {
        return $this->hostnameLookup;
    }

    public function enableHostnameLookup(): void
    {
        $this->hostnameLookup = true;
    }

    public function disableHostnameLookup(): void
    {
        $this->hostnameLookup = false;
    }

    public function isSecurityModuleEnabled(): bool
    {
        return $this->securityModule;
    }

    public function enableSecurityModule(): void
    {
        $this->securityModule = true;
    }

    public function disableSecurityModule(): void
    {
        $this->securityModule = false;
    }
}
