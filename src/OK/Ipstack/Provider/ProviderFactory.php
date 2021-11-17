<?php

namespace OK\Ipstack\Provider;

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
        $class = self::$types[$type] ?? null;

        if ($class === null) {
            throw new InvalidProviderException("Invalid provider type '%s'. Please, use one of existing protocols [%s]", $type, implode(',', self::$types));
        }

        return new $class($key);
    }
}
