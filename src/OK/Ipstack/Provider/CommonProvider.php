<?php

namespace OK\Ipstack\Provider;

use OK\Ipstack\Entity\Params\ParameterBagInterface;
use OK\Ipstack\Exceptions\InvalidApiException;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
abstract class CommonProvider implements DataProviderInterface
{
    protected static $url = '';
    private ParameterBagInterface $params;

    /**
     * @throws InvalidApiException
     */
    public function get(string $ip): array
    {
        $result = $this->request($this->getUrl($ip));
                    
        if (isset($result['error'])) {
            throw new InvalidApiException("[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}");
        }

        return $result;
    }
    
    /**
     * @throws InvalidApiException
     */
    public function getBulk(array $ips): array
    {
        $result = $this->request($this->getUrl(implode(',', $ips)));
                    
        if ($result['error']) {
            throw new InvalidApiException("[{$result['error']['code']}][{$result['error']['type']}}] {$result['error']['info']}}");
        }

        return $result;
    }

    /**
     * @throws InvalidApiException
     */
    protected function request(string $url): array
    {
        $c = curl_init($url);

        if ($c === false) {
            throw new InvalidApiException("Can't init connection to $url");
        }

        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($c);
        curl_close($c);
        
        if ($this->getParams()->getFormat() === ParameterBagInterface::FORMAT_XML) {
            $xml = simplexml_load_string($response);
            $response = json_encode($xml);
        }
        
        return json_decode($response, true);
    }

    public function getParams(): ParameterBagInterface
    {
        return $this->params;
    }

    public function setParams(ParameterBagInterface $params): void
    {
        $this->params = $params;
    }
}
