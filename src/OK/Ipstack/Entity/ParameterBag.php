<?php

namespace OK\Ipstack\Entity;

use OK\Ipstack\Exceptions\InvalidParameterException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ParameterBag
{
    public const PROTOCOL_HTTP = 'http';
    public const PROTOCOL_HTTPS = 'https';

    public const FORMAT_JSON = 'json';
    public const FORMAT_XML = 'xml';

    public const FIELDS = [
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

    public const LANGUAGES = [
        'en',
        'de',
        'es',
        'fr',
        'ja',
        'pt-br',
        'ru',
        'zh'
    ];
    
    private static array $formats = [
        self::FORMAT_JSON,
        self::FORMAT_XML
    ];
    
    private static array $protocols = [self::PROTOCOL_HTTP, self::PROTOCOL_HTTPS];

    protected string $key;
    protected string $protocol;
    protected array $fields;
    protected string $language;
    protected string $format;
    protected bool $hostnameLookup = false;
    protected bool $securityModule = false;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->protocol = self::PROTOCOL_HTTP;
        $this->fields = [];
        $this->language = 'en';
        $this->format = self::FORMAT_JSON;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function isHostnameLookupEnabled(): bool
    {
        return $this->hostnameLookup;
    }

    public function enableHostnameLookup(): ParameterBag
    {
        $this->hostnameLookup = true;

        return $this;
    }

    public function disableHostnameLookup(): ParameterBag
    {
        $this->hostnameLookup = false;

        return $this;
    }

    public function isSecurityModuleEnabled(): bool
    {
        return $this->securityModule;
    }

    public function enableSecurityModule(): ParameterBag
    {
        $this->securityModule = true;

        return $this;
    }

    public function disableSecurityModule(): ParameterBag
    {
        $this->securityModule = false;

        return $this;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    /**
     * @throws InvalidParameterException
     */
    public function setProtocol(string $protocol): ParameterBag
    {
        if (!in_array($protocol, self::$protocols)) {
            throw new InvalidParameterException(sprintf("Invalid protocol '%s'. Please, use one of existing protocols [%s]", $protocol, implode(',', self::$protocols)));
        }
        
        $this->protocol = $protocol;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @throws InvalidParameterException
     */
    public function setLanguage(string $language): ParameterBag
    {
        if (!in_array($language, self::LANGUAGES)) {
            throw new InvalidParameterException(sprintf("Invalid language '%s'. Please, use one of existing languages [%s]", $language, implode(',', self::$languages)));
        }
        
        $this->language = $language;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @throws InvalidParameterException
     */
    public function setFormat(string $format): ParameterBag
    {
        if (!in_array($format, self::$formats)) {
            throw new InvalidParameterException(sprintf("Invalid output format '%s'. Please, use one of existing formats [%s]", $format, implode(',', self::$formats)));
        }
        
        $this->format = $format;
        
        return $this;
    }

    /**
     * @throws InvalidParameterException
     */
    public function addField(string $field): ParameterBag
    {
        if (!in_array($field, self::FIELDS)) {
            throw new InvalidParameterException(sprintf("Invalid field '%s'. Please, use one of existing fields [%s]", $field, implode(',', self::FIELDS)));
        }
        
        if (!in_array($field, $this->fields)) {
            $this->fields[] = $field;
        }
        
        return $this;
    }

    public function removeField(string $field): ParameterBag
    {
        if (($key = array_search($field, $this->fields)) !== false) {
            unset($this->fields[$key]);
        }
        
        return $this;
    }

    /**
     * @throws InvalidParameterException
     */
    public function setFields(array $fields): ParameterBag
    {
        foreach ($fields as $field) {
            $this->addField($field);
        }
        
        return $this;
    }

    public function clearFields(): ParameterBag
    {
        $this->fields = [];
        
        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
