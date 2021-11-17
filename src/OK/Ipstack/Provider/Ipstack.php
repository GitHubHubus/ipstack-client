<?php

namespace OK\Ipstack\Provider;

use OK\Ipstack\Entity\Dto\DtoInterface;
use OK\Ipstack\Entity\Dto\LocationFactory;
use OK\Ipstack\Entity\Params\IpstackParams;
use OK\Ipstack\Exceptions\InvalidApiException;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Ipstack extends CommonProvider
{
    protected static $url = 'api.ipstack.com';
    private LocationFactory $locationFactory;

    public function __construct(IpstackParams $params, LocationFactory $factory)
    {
        parent::__construct($params);

        $this->locationFactory = $factory;
    }

    /**
     * @throws InvalidApiException
     */
    public function getDto(string $ip): DtoInterface
    {
        $data = $this->get($ip);

        return $this->locationFactory->create($data);
    }

    /**
     * @throws InvalidApiException
     */
    public function getDtoBulk(array $ips): array
    {
        $result = $this->getBulk($ips);

        return count($ips) > 1 ? $this->locationFactory->createArray($result) : [$this->locationFactory->create($result)];
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
