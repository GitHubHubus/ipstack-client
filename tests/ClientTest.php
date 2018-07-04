<?php

namespace Tests;

use Tests\TestCase;
use OK\Ipstack\Client;
use OK\Ipstack\Entity\Location;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClientTest extends TestCase
{
    /**
     * @var Client 
     */
    protected $client;
    
    protected function setUp()
    {
        $this->client = new Client(self::API_KEY);
    }

    /**
     * @param string $key
     * @param string $protocol
     * @param string $ip
     * @param array $fields
     * @param string $language
     * 
     * @dataProvider getUrlProvider
     */
    public function testGetUrl($key, $protocol, $ip, $fields, $language)
    {
        $client = new Client($key);
        $client->getParams()->setProtocol($protocol)
                ->setFields($fields)
                ->setLanguage($language);
        
        $this->assertEquals("{$protocol}://" . Client::URL . "/{$ip}?access_key={$key}&fields=" . implode(',', $fields) . "&language={$language}", $client->getUrl($ip));
    }

    /**
     * @param array $data
     * @param Location $result
     *
     * @dataProvider createLocationProvider
     */
    public function testCreateLocation($data, $result)
    {
        $createLocationMethod = $this->makeCallable($this->client, 'createLocation');
        
        $this->assertEquals($result, $createLocationMethod->invokeArgs($this->client, [$data]));
    }

    public function getUrlProvider()
    {
        return [
            ['key1', 'http', '12.12.12.12', ['main'], 'en'],
            ['key1', 'https', '12.12.12.12', ['country_name', 'country_code'], 'en'],
            ['key1', 'http', '12.12.12.12,234.123.123.123', [], 'en'],
        ];
    }
    
    public function createLocationProvider()
    {
        $location1 = new Location();
        $location1->setCity('Moscow')
                ->setValid(false);
        
        $location2 = new Location();
        $location2->setCity('New York')
                ->setIp('211.234.3.4')
                ->setValid(true);
        
        $location3 = new Location();
        $location3->setZip('25721')
                ->setIp('1.1.1.1')
                ->setValid(false);
        
        return [
            [
                ['city' => 'Moscow'], $location1
            ],
            [
                ['city' => 'New York', 'ip' => '211.234.3.4', 'type' => 'ipv4'], $location2
            ],
            [
                ['zip' => '25721', 'ip' => '1.1.1.1', 'type' => null], $location3
            ]
        ];
    }
}

