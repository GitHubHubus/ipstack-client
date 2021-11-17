<?php

namespace OK\Ipstack\Provider;

use OK\Ipstack\Entity\Dto\DtoInterface;
use OK\Ipstack\Entity\Params\ParameterBagInterface;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
interface DataProviderInterface
{
    public function get(string $ip): array;
    public function getDto(string $ip): DtoInterface;
    public function getBulk(array $ips): array;
    public function getDtoBulk(array $ips): array;
    public function getUrl(string $ip): string;
    public function getParams(): ParameterBagInterface;
    public function setParams(ParameterBagInterface $params): void;
}
