<?php

namespace OK\Ipstack\Provider;

use OK\Ipstack\Entity\Dto\DtoInterface;
use OK\Ipstack\Entity\Dto\LocationFactory;
use OK\Ipstack\Entity\Params\IpapiParams;
use OK\Ipstack\Exceptions\InvalidApiException;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Ipapi extends CommonProvider
{
    protected static $url = 'api.ipapi.com';
    private IpapiParams $params;
    private LocationFactory $locationFactory;

    public function __construct(IpapiParams $params, LocationFactory $factory)
    {
        $this->params = $params;
        $this->locationFactory = $factory;
    }

    /**
     * @throws InvalidApiException
     */
    public function getDto(string $ip): DtoInterface
    {
        $data = parent::get($ip);

        return $this->locationFactory->create($data);
    }

    /**
     * @throws InvalidApiException
     */
    public function getDtoBulk(array $ips): array
    {
        $result = $this->getBulk($ips);

        return $this->locationFactory->createArray($result);
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
}
