<?php

namespace OK\Ipstack\Provider;

use OK\Ipstack\Entity\Dto\LocationFactory;
use OK\Ipstack\Entity\Params\IpapiParams;
use OK\Ipstack\Entity\Params\IpstackParams;
use OK\Ipstack\Exceptions\InvalidProviderException;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ProviderFactory
{
    public const TYPE_IPSTACK = 'ipstack';
    public const TYPE_IPAPI = 'ipapi';

    private static array $types = [
        self::TYPE_IPSTACK => Ipstack::class,
        self::TYPE_IPAPI => Ipapi::class
    ];

    public static function createInstance(string $key, string $type): DataProviderInterface
    {
        switch ($type) {
            case self::TYPE_IPSTACK:
                return new Ipstack(new IpstackParams($key), new LocationFactory());
            case self::TYPE_IPAPI:
                return new Ipapi(new IpapiParams($key), new LocationFactory());
            default:
                throw new InvalidProviderException("Invalid provider type '%s'. Please, use one of existing protocols [%s]", $type, implode(',', self::$types));
        }
    }
}
