<?php

namespace OK\Ipstack;

use OK\Ipstack\Entity\Dto\DtoInterface;
use OK\Ipstack\Entity\Params\ParameterBagInterface;
use OK\Ipstack\Provider\DataProviderInterface;
use OK\Ipstack\Provider\ProviderFactory;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class Client
{
    private DataProviderInterface $provider;

    /**
     * @param string $key <p>API Access Key</p>
     *
     * @throws Exceptions\InvalidProviderException
     */
    public function __construct(string $key, ?string $type = ProviderFactory::TYPE_IPSTACK)
    {
        $this->provider = ProviderFactory::createInstance($key, $type);
    }

    /**
     * @return DtoInterface|array
     */
    public function get(string $ip, bool $isArray = true)
    {
        return $isArray ? $this->provider->get($ip) : $this->provider->getDto($ip);
    }

    public function getBulk(array $ips, bool $isArray = true): array
    {
        return $isArray ? $this->provider->getBulk($ips) : $this->provider->getDtoBulk($ips);
    }

    public function getParams(): ParameterBagInterface
    {
        return $this->provider->getParams();
    }

    public function setParams(ParameterBagInterface $params): void
    {
        $this->provider->setParams($params);
    }
}
