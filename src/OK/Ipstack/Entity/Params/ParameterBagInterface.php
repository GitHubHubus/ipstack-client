<?php

namespace OK\Ipstack\Entity\Params;

use OK\Ipstack\Exceptions\InvalidParameterException;

/**
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface ParameterBagInterface
{
    public const PROTOCOL_HTTP = 'http';
    public const PROTOCOL_HTTPS = 'https';

    public const FORMAT_JSON = 'json';
    public const FORMAT_XML = 'xml';

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

    public function getKey(): string;
    public function getFormat(): string;
    public function getProtocol(): string;
    public function getLanguage(): string;
}
